<?php

namespace App\Http\Controllers;

use App\Models\TicketReply;
use Carbon\Carbon;
use App\Models\Faq;
use App\Models\User;
use App\Models\Layout;
use App\Models\Contact;
use App\Models\Category;
use App\Models\SubCategory;
use Exception;
use Illuminate\Http\Request;
use App\Models\GenaralSetting;
use App\Models\Knowledge;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\Types\Parent_;

class BackendController extends Controller
{
    public function __construct()
    {
        Parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //dashboard
    public function adminDashboard()
    {
        try {
            $data['title'] = 'Dashboard';
            $data['totalUser'] = User::where('user_type', 'USR')->get()->count();
            $data['contactMessage'] = Contact::all()->count();
            $data['totalKnowledge'] = Knowledge::all()->count();
            $data['totalTicket'] = Ticket::all()->count();

            $data['admin_user'] = Auth::user();
            return view('admin.dashboard', $data);
        } catch (Exception $th) {
            return back()->with('error', $th->getMessage());
        }
    }
    // admin profile
    public function adminProfile()
    {
        try {
            $data['title'] = 'Profile Info';
            $data['admin_user'] = Auth::user();
            return view('admin.profile.show', $data);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e);
        }
    }

    public function adminProfileUpdate(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
            ], [
                'name' => 'Admin name is required.',
                'email' => 'Email is required.',

            ]);

            $acceptable = ['jpeg', 'png', 'jpg', 'gif'];
            if ($request->hasFile('profile_photo_path')) {
                foreach ($request->profile_photo_path as $img) {
                    if (!in_array($img->getClientOriginalExtension(), $acceptable)) {
                        return back()->with('error', 'Only jpeg, png, jpg and gif file is supported.');
                    }
                }
            }

            $user = User::find($request->id);

            $profilePhoto = $user->profile_photo_path;

            if ($request->hasFile('profile_photo_path')) {
                // delete existing image
                $file = 'upload/backend/profile/' . $profilePhoto;
                if (file_exists(public_path($file))) {
                    unlink(public_path($file));
                }

                // insert new image
                $images = $request->profile_photo_path;
                foreach ($images as $img) {
                    //image name
                    $profilePhoto = time() . '.' . $img->getClientOriginalName();
                    // Upload image
                    $img->move(public_path('/upload/backend/profile'), $profilePhoto);
                }
            }


            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->profile_photo_path = $profilePhoto;
            $user->save();
            return back()->with('success', 'User Profile Updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e);
        }
    }

    public function adminChangePassword()
    {
        try {
            $admin_user = Auth::user();
            return view('admin.profile.change-password')->with('admin_user', $admin_user);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e);
        }
    }

    public function updateAdminPassword(Request $request)
    {
        try {
            $request->validate([
                'current_password' => 'required',
                'password' => 'required|string|min:8|confirmed',
            ]);

            if (Hash::check($request->current_password, Auth::user()->password)) {

                DB::table('users')
                    ->where('id', Auth::user()->id)
                    ->where('user_type', 'ADM')
                    ->update(['password' => Hash::make($request->password)]);

                if ($request->has('keep_me_login')) {
                    return redirect()->back()->with('success', ' Password Changed Successfully');
                } else {
                    Auth::logout();
                    return redirect('/');
                }
            } else {
                return redirect()->back()->with('error', 'Old Password dont match');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e);
        }
    }

    /*>>>>>>>>>>>>>>>>>>>>>>>General Settings>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>*/
    public function generalSettings()
    {
        try {
            $data['title'] = 'General Settings';
            $data['admin_user'] = Auth::user();
            $data['generalSettings'] = GenaralSetting::first();
            return view('admin.settings.general-settings', $data);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e);
        }
    }

    public function storeGeneralSetting(Request $request)
    {
        $request->validate([
            'site_name' => 'required',
            'site_tag_line' => 'required',
            'author_name' => 'required',
            'footer_copy_right' => 'required',
            'og_meta_title' => 'nullable',
            'og_meta_description' => 'nullable',
            'og_meta_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ], [
            'site_name' => 'Site name is required.',
            'site_tag_line' => 'Site tag line is required.',
            'author_name' => 'Author name  is required.',
            'footer_copy_right' => 'Footer copy right is required.'
        ]);
        try {

            $store = new GenaralSetting();

            // Check if a profile image has been uploaded
            if ($request->has('og_meta_image')) {
                //image name
                $ogMetaImage = time() . '.' . $request->file('og_meta_image')->getClientOriginalName();

                // Upload image
                $request->og_meta_image->move(public_path('/upload/frontend/'), $ogMetaImage);

                //save image name to table
                $store->og_meta_image = $ogMetaImage;
            }


            $store->site_name = $request->input('site_name');
            $store->site_tag_line = $request->input('site_tag_line');
            $store->site_sub_tag_line = $request->input('site_sub_tag_line');
            $store->author_name = $request->input('author_name');
            $store->footer_copy_right = $request->input('footer_copy_right');
            $store->og_meta_title = $request->input('og_meta_title');
            $store->og_meta_description = $request->input('og_meta_description');
            $store->save();


            return  back()->with('success', 'General Settings created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e);
        }
    }

    public function updateGeneralSettings($id, Request $request)
    {
        try {
            $request->validate([
                'site_name' => 'required',
                'site_tag_line' => 'required',
                'author_name' => 'required',
                'footer_copy_right' => 'required',
                'og_meta_title' => 'nullable',
                'og_meta_description' => 'nullable',
                'og_meta_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',

            ], [
                'site_name' => 'Site name is required.',
                'site_tag_line' => 'Site tag line is required.',
                'author_name' => 'Author name  is required.',
                'footer_copy_right' => 'Footer copy right is required.',
            ]);

            $store = GenaralSetting::find($id);

            $ogMetaImage = $store->og_meta_image;

            if ($request->has('og_meta_image')) {
                // delete existing image
                if(!empty($ogMetaImage)){
                    $file = public_path('/upload/frontend/' . $ogMetaImage);
                    unlink($file);
                }
                //image name
                $ogMetaImage = time() . '.' . $request->file('og_meta_image')->getClientOriginalName();
                // Upload image
                $request->og_meta_image->move(public_path('/upload/frontend/'), $ogMetaImage);
            }


            $store->site_name = $request->input('site_name');
            $store->site_tag_line = $request->input('site_tag_line');
            $store->site_sub_tag_line = $request->input('site_sub_tag_line');
            $store->author_name = $request->input('author_name');
            $store->footer_copy_right = $request->input('footer_copy_right');
            $store->og_meta_title = $request->input('og_meta_title');
            $store->og_meta_description = $request->input('og_meta_description');
            $store->og_meta_image = $ogMetaImage;
            $store->save();


            return back()->with('success', 'General Settings created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e);
        }
    }



    public function contact()
    {
        $data['contacts'] = Contact::all();
        $data['title'] = 'User Contact';
        $data['admin_user'] = Auth::user();

        return view('admin.contact', $data);
    }

    public function contactview($id)
    {
        try {
            $data['title'] = 'Contact';
            $data['contact'] = Contact::findOrFail($id);
            $data['admin_user'] = Auth::user();

            $data['contact']->status = 2;
            $data['contact']->save();

            return view('admin.view-contact', $data);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e);
        }
    }

    public function contactDelete($id)
    {
        try {
            Contact::findOrFail($id)->delete();
            return redirect('admin/contact')->with('success', 'Contact has been deleted successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e);
        }
    }

    /*>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> User  >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>*/

    public function registeredUsers()
    {
        try {
            $data['users'] = User::all();
            $data['title'] = 'Registered Users';
            $data['admin_user'] = Auth::user();
            return view('admin.user.registered-users', $data);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e);
        }
    }

    public function registeredUsersView($id)
    {
        try {
            $data['title'] = 'Registered User';
            $data['users'] = User::findOrFail($id);
            $data['admin_user'] = Auth::user();
            return view('admin.user.view-registered-users', $data);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e);
        }
    }

    public function registeredUsersDelete($id)
    {
        try {
            User::findOrFail($id)->delete();
            return redirect('admin/registered-users')->with('success', 'Registered user has been deleted successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e);
        }
    }

    public function createUser()
    {
        try {
            $data['title'] = 'Create User';
            $data['admin_user'] = Auth::user();
            return view('admin.user.create-user', $data);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e);
        }
    }

    public function storeCreateUser(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'password' => 'required'
            ]);
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->user_type = $request->input('type');
            $user->password = Hash::make($request->input('password'));
            $user->save();
            return redirect('admin/create-user')->with('success', 'User create successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e);
        }
    }

    /*>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Admin  >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>*/

    public function createAdmin()
    {
        try {
            $data['title'] = 'Create Admin';
            $data['admin_user'] = Auth::user();
            return view('admin.user.create-admin', $data);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e);
        }
    }

    public function storeCreateAdmin(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'password' => 'required'
            ]);
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->user_type = $request->input('type');
            $user->password = Hash::make($request->input('password'));
            $user->save();
            return redirect('admin/create-admin')->with('success', 'Admin create successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e);
        }
    }




    /*>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Categories  >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>*/

    public function allCategories(){
        try{
            $data['categories'] = Category::all();
            $data['title'] = 'Article Categories';
            $data['admin_user'] = Auth::user();

            return view('admin.category.category-index', $data);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function createCategorForm($id = null)
    {
        try {
            $data['title'] = 'Create Category';
            $data['admin_user'] = Auth::user();
            $data['category'] = Category::where('id', $id)->first();
            return view('admin.category.category-form', $data);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function storeCategory(Request $request,$id=null)
    {

        try {
            $request->validate([
                'name' => 'required',
            ]);
            $category = Category::find($id);
            if(empty($category)){
                $category = new Category();
            }

            $category->name = $request->input('name');

            if ($request->has('status')) {
                $category->status = true;
            } else {
                $category->status = false;
            }
            $category->save();

            return redirect()->route('admin.categories')->with('success', 'Category create successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e);
        }
    }

    public function categoryDelete($id)
    {
        try {
            Category::findOrFail($id)->delete();
            return redirect()->route('admin.categories')->with('success', 'Category has been deleted successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e);
        }
    }


    /*>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Sub Categories  >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>*/

    public function allSubCategories(){
        try{
            $data['sub_categories'] = SubCategory::all();
            $data['title'] = 'Sub Categories';
            $data['admin_user'] = Auth::user();

            return view('admin.subCategory.sub-category-index', $data);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function createSubCategorForm($id = null)
    {
        try {
            $data['title'] = 'Create Sub Category';
            $data['admin_user'] = Auth::user();
            $data['categories'] = Category::all();
            $data['subcategory'] = SubCategory::where('id', $id)->first();
            return view('admin.subCategory.sub-category-form', $data);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function storeSubCategory(Request $request,$id=null)
    {

        try {
            $request->validate([
                'name' => 'required',
                'category_id' => 'required',
            ]);
            $subcategory = SubCategory::find($id);
            if(empty($subcategory)){
                $subcategory = new SubCategory();
            }

            $subcategory->name = $request->input('name');
            $subcategory->category_id = $request->input('category_id');


            $subcategory->save();

            return redirect()->route('admin.sub-categories')->with('success', 'Sub Category create successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e);
        }
    }

    public function subCategoryDelete($id)
    {
        try {
            SubCategory::findOrFail($id)->delete();
            return redirect()->route('admin.sub-categories')->with('success', 'Sub Category has been deleted successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e);
        }
    }
    /*>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Categories  >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>*/

    public function allKnowledge(){
        try{
            $data['knowledges'] = Knowledge::all();
            $data['title'] = 'All Knowledge';
            $data['admin_user'] = Auth::user();

            return view('admin.knowledge.knowledge-index', $data);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function createKnowledgeForm($id = null)
    {
        try {
            $data['title'] = 'Create Category';
            $data['admin_user'] = Auth::user();

            if($id!=null){
                $data['knowledge'] = Knowledge::where('id', $id)->first();
                $category_id=$data['knowledge']->subcategory->category->id;
                $data['subcategories'] = SubCategory::where('category_id',$category_id)->get();
            }else {
                $data['knowledge']=null;
            }

            $data['categories'] = Category::all();

            return view('admin.knowledge.knowledge-form', $data);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e);
        }
    }

    public function getKnowledgeSubcategory(Request $request){

        if($request->isMethod('get')){
            $id = $request->id;
            $subcategories = SubCategory::where('category_id',$id)->get();
            return view('admin.knowledge.get-knowledge-subcategory',compact('subcategories'));
        }else die(json_encode(array('success'=>false,'message'=>'Invalid request')));

    }

    public function storeKnowledge(Request $request,$id=null)
    {

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'sub_categories_id' => 'required',
        ], [
            'title' => 'Title is required.',
            'description' => 'Description is required.',
            'sub_categories_id' => 'Category is required.',
        ]);


        try {

            $store = Knowledge::find($id);
            if(empty($store)){
                $store = new Knowledge();
            }


            $store->title = $request->input('title');
            $store->tags = $request->input('tags');
            $store->sub_categories_id = $request->input('sub_categories_id');
            $store->description = $request->input('description');
            $store->user_id = $request->input('user_id');

            if ($request->has('status')) {
                $store->status = true;
            } else {
                $store->status = false;
            }

            $store->save();

            return redirect()->route('admin.knowledge')->with('success', 'Knowledge create successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e);
        }
    }

    public function knowledgeDelete($id)
    {
        try {
            Knowledge::findOrFail($id)->delete();
            return redirect()->route('admin.knowledge')->with('success', 'Knowledge has been deleted successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e);
        }
    }



    /*>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> For FAQ   >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>*/

    public function faqIndex()
    {
        try{
            $data['faqs'] =  Faq::all();
            $data['title'] = 'Frequently Ask Question';
            $data['admin_user'] = Auth::user();

            return view('admin.faq.faq-index', $data);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e);
        }

    }


    public function faqShow(Faq $faq = null){

        try {
            $data['title'] = 'Create Faq';
            $data['admin_user'] = Auth::user();
            $data['faq'] = $faq;
            return view('admin.faq.faq-form', $data);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e);
        }
    }

    public function faqActivation(Faq $faq)
    {
        try{
            if($faq->status){
                $faq->status = false;
                $faq->save();
            }else{
                $faq->status = true;
                $faq->save();
            }
            return response()->json($faq);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e);
        }
    }

    public function faqStore(Request $request, Faq $faq = null)
    {
        try{
            $this->validate($request, [
                'question' => 'required',
                'answer' => 'required|min:5',
            ]);

            $nid = $faq?$faq->id:0;

            $data = array();
            $data['question'] = $request->question;
            $data['answer'] = $request->answer;
            if ($request->has('status')){
                $data['status'] = true;
            }else{
                $data['status'] = false;
            }

            Faq::updateOrcreate(
                ['id'=>$nid],
                [
                    'question'=>$data['question'],
                    'answer'=>$data['answer'],
                    'status'=>$data['status'],
                ]
            );

            return redirect()->route('admin.faq.index')->with( 'success','Faq has been saved successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e);
        }
    }

    public function faqDelete(Faq $faq)
    {
        try{
            $faq->delete();
            return back()->with('success','Faq has been deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e);
        }
    }


    /*>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> For FAQ   >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>*/

    public function ticketsIndex()
    {
        try{
            $data['tickets'] =  Ticket::all();
            $data['title'] = 'All Tickets';
            $data['admin_user'] = Auth::user();

            return view('admin.tickets.ticket-index', $data);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e);
        }

    }

    public function ticketShow(Ticket $ticket = null){

//        try {
            $data['title'] = 'Ticket View';
            $data['admin_user'] = Auth::user();
            $data['ticket'] = $ticket;
            return view('admin.tickets.ticket-view', $data);
        /*} catch (Exception $e) {
            return redirect()->back()->with('error', $e);
        }*/
    }

    public function ticketDelete(Ticket $ticket)
    {
        try{
            $ticket->delete();
            return back()->with('success','Ticket has been deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e);
        }
    }

    public function storeTicketReply(Request $request)
    {

        $request->validate([
            'body' => 'required',
        ], [
            'body' => 'Body is required.',

        ]);

        try {

            $t_reply = new TicketReply();
            $t_reply->user_id = auth()->user()->id;
            $t_reply->ticket_id = $request->ticket_id;
            $t_reply->body = $request->body;



            $t_reply->save();

            return redirect()->back()->with('success', 'Ticket replied successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e);
        }
    }





}
