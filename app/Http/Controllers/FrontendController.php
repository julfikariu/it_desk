<?php

namespace App\Http\Controllers;


use App\Models\Ads;
use App\Models\Faq;
use App\Models\Page;
use App\Models\TicketReply;
use App\Models\User;
use App\Mail\OTPMail;
use App\Models\Ticket;
use App\Models\Contact;
use App\Models\Encrypt;
use App\Models\Category;
use App\Mail\GetMySecret;
use App\Models\Knowledge;
use App\Models\ShareASecret;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Response;

class FrontendController extends Controller
{

    public function __construct()
    {
        Parent::__construct();
    }

    public function welcome(){
    
        try{
            $categories = Category::where('status',true)->get();
            $title = env('APP_NAME');
            return view('welcome',compact('categories','title'));
        }catch(\Exception $e){
            return view('error.404');
        }
    }


    public function singleKnowledge($category_id,$id){

        try{
            $data['category'] = Category::where('id',$category_id)->first();
            $data['knowledge'] = Knowledge::where('id',$id)->first();
            return view('help-center.single-article',$data);
        }catch(\Exception $e){
            return view('error.404');
        }
    }

    public function singleCategory($category_id){

        try{
            $data['category'] = Category::where('id',$category_id)->first();

            return view('help-center.single-category',$data);
        }catch(\Exception $e){
            return view('error.404');
        }
    }

    public function singleSubcategory($sub_category_id){

        try{
            $data['subcategory'] = SubCategory::where('id',$sub_category_id)->first();
            $data['category'] = Category::where('id',$data['subcategory']->category->id)->first();

            return view('help-center.single-sub-category',$data);
        }catch(\Exception $e){
            return view('error.404');
        }
    }

    // For Create knowlwdge
    public function createKnowledge(){
        try {
            $data['sub_categories'] = SubCategory::all();
            $data['user'] = Auth::user();
            return view('profile.create-knowledge',$data);
        } catch (\Exception $e) {
//            return redirect()->back()->with('error', $e);
            return view('error.404');
        }
    }

    public function storeKnowledge(Request $request)
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

        // try {       

           
            // $tags = explode(",", $request->tags);
        
            $store = new Knowledge();
            $store->title = $request->input('title');
            $store->tags = $request->input('tags');
            $store->sub_categories_id = $request->input('sub_categories_id');
            $store->description = $request->input('description');
            $store->user_id = $request->input('user_id');

            $store->save();

            return redirect()->back()->with('success', 'Your Knowledge has been received, Our consultant will publish soon!');
//         } catch (\Exception $e) {
// //            return redirect()->back()->with('error', $e->getMessage());
//             return view('error.404');
//         }
    }

    public function knowledgeSearch(Request $request){
        $search = $request->input('search');

        $knowledges = Knowledge::query()
            ->where('title', 'LIKE', "%{$search}%")
            ->get();

        return view('frontend-pages.search-results',compact('knowledges'));
    }

    // For Open ticket 
    public function openTicket(){
        try{
            if(!Auth::check()){
                return redirect()->back()->with('error', 'Please login');
            }
            $data['categories'] = Category::where('status',true)->get();
            return view('open-ticket',$data);
        }catch(\Exception $e){
            return view('error.404');
        }
    }

    public function ticketStore(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'priority' => 'required',
            'category_id' => 'required',
            'body' => 'required'

        ], [
            'subject' => 'Subject is required.',
            'priority' => 'First name is required.',
            'category_id' => 'Email is required.',
            'body' => 'Message is required.'

        ]);

        try {

            $store = new Ticket();
            $store->subject = $request->input('subject');
            $store->priority = $request->input('priority');
            $store->category_id = $request->input('category_id');
            $store->body = $request->input('body');
            $store->user_id = $request->input('user_id');
            $store->save();

            return redirect()->back()->with('success', 'Your ticket has been received, Our consultant will reply you soon!');
        } catch (\Exception $e) {
//            return redirect()->back()->with('error', $e->getMessage());
            return view('error.404');
        }
    }

    public function ticketShow(Ticket $ticket = null){

        try {
            $data['title'] = 'Ticket View';
            $data['user'] = Auth::user();
            $data['ticket'] = $ticket;
            return view('frontend-pages.ticket-view', $data);
        } catch (\Exception $e) {
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


    // Dashboard
    public function dashboard()
    {
        try {
            $user = Auth::user();
            $myTickets = Ticket::where('user_id', $user->id)->get();

            return view('dashboard', compact('user', 'myTickets'));
        } catch (\Exception $e) {
//            return redirect()->back()->with('error', $e);
            return view('error.404');
        }
    }


    // User profile
    public function userProfile()
    {
        try {
            // $user = User::where('id',1)->first();
            $user = Auth::user();

            return view('profile.show')->with('user', $user);
        } catch (\Exception $e) {
//            return redirect()->back()->with('error', $e);
            return view('error.404');
        }
    }
    // User profile update
    public function userProfileUpdate(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'profile_photo_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',

            ], [
                'name' => 'Name is required.',
                'email' => 'Email is required.',

            ]);

            $user = User::find($request->id);

            $profilePhoto = $user->profile_photo_path;

            if ($request->has('profile_photo_path')) {
                // delete existing image
                $file = public_path('/upload/frontend/profile/' . $profilePhoto);
                @unlink($file);
                //image name
                $profilePhoto = time() . '.' . $request->file('profile_photo_path')->getClientOriginalName();
                // Upload image
                $request->profile_photo_path->move(public_path('/upload/frontend/profile'), $profilePhoto);
            }


            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->profile_photo_path = $profilePhoto;
            $user->save();
            return back()->with('success', 'User Profile Updated successfully.');
        } catch (\Exception $e) {
//            return redirect()->back()->with('error', $e);
            return view('error.404');
        }
    }

    public function userChangePassword()
    {
        try {
            $user = Auth::user();
            return view('profile.change-password')->with('uaer', $user);
        } catch (\Exception $e) {
//            return redirect()->back()->with('error', $e);
            return view('error.404');
        }
    }

    public function updateUserPassword(Request $request)
    {
        try {
            $request->validate([
                'current_password' => 'required',
                'password' => 'required|string|min:8|confirmed',
                'password_confirmation' => 'required',
            ]);

            $user = Auth::user();

            if (!Hash::check($request->current_password, $user->password)) {
                return back()->with('error', 'Current password does not match!');
            }

            $user->password = Hash::make($request->password);
            $user->save();

            return back()->with('success', 'Password change successfully.');
        } catch (\Exception $e) {
//            return redirect()->back()->with('error', $e);
            return view('error.404');
        }
    }

    // contact page
    public function contact()
    {
        try {
/*            $page = Page::where(['name' => 'contact', 'status' => true])->first();*/
            $title = env('APP_NAME').' | '.'Contact Us';
            return view('contact', compact('title'));
        } catch (\Exception $e) {
//            return redirect()->back()->with('error', $e);
            return view('error.404');
        }
    }



    // delete pages
    public function deleteAccount()
    {
        try {
            $user = Auth::user();
            $page = Page::where(['name' => 'delete_account', 'status' => true])->first();
            $title = env('APP_NAME').' | '.ucwords(strtolower($page->title));
            if ($user) {
                return view('frontend-pages.delete-account-pages.delete-account', compact('page', 'title'));
            } else {
                return view('frontend-pages.delete-account-pages.delete-page', compact('page', 'title'));
            }
        } catch (\Exception $e) {
//            return redirect()->back()->with('error', $e);
            return view('error.404');
        }
    }

    // contact store
    public function contactStore(Request $request)
    {
        $request->validate([
            'f_name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required'

        ], [
            'f_name' => 'First name is required.',
            'email' => 'Email is required.',
            'subject' => 'Subject is required.',
            'message' => 'Message is required.'

        ]);

        try {

            $name = $request->f_name;
            if (isset($request->l_name)) {
                $name .= " " . $request->l_name;
            }

            $store = new Contact();
            $store->f_name = $name;
            $store->email = $request->input('email');
            $store->subject = $request->input('subject');
            $store->message = $request->input('message');
            $store->status = 1;
            $store->save();

            return redirect()->back()->with('success', 'Your message has been received, Our consultant will reply you soon!');
        } catch (\Exception $e) {
//            return redirect()->back()->with('error', $e->getMessage());
            return view('error.404');
        }
    }



    public function faqs(){
        try{
            $faqs = Faq::where('status', 1)->get();
            return view('frontend-pages.faqs',compact('faqs'));
        }catch (\Exception $e) {
            return view('error.404');
        }
    }

}
