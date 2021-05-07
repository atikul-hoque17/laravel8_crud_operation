<?php

namespace App\Http\Controllers;

use App\Models\userinfo;
use Illuminate\Http\Request;
use App\Models\Product;

class UserinfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        ////for retrive all user from db
        $userinfo = Userinfo::latest()->get();
        //return response()->json($userinfo);
  
        return view('userinfo.index',compact('userinfo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //user create from view
        return view('userinfo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //request validation by laravel
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:userinfos',
            'gender' => 'required',
            'skills' => 'required',
        ]);

     //   return response()->json($request); //for check requested input

       $skills = $request->input('skills');
         $skillsarray = array();
        foreach($skills as $skill){
           $skillsarray[] = $skill;
        }

         //for insert input
         $userinfo= new Userinfo();
          $userinfo->name =$request->name;
          $userinfo->email =$request->email;
          $userinfo->image ="userImage/no_image.png";
          $userinfo->gender =$request->gender;   
          $userinfo->skills = json_encode($skillsarray);   
          $userinfo->save();

        //for image uploading

        if( $picInfo=$request->file('picture')){

           // return response()->json($picInfo);
             $lastID=$userinfo->id;
              $picInfo=$request->file('picture');     
              $picName=$lastID.$picInfo->getClientOriginalName();
            //  $picName=$picInfo->getClientOriginalName();
              $folder="userImage/";
              $picInfo->move($folder,$picName);


          
              
              $savefolder="userImage/";
              $picUrl=$savefolder.$picName;      
              $userinfopic= Userinfo::find($lastID);
              $userinfopic->image=$picUrl;
              $userinfopic->save();

        }


      
        return redirect()->route('userinfo.index')
                        ->with('success','User created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\userinfo  $userinfo
     * @return \Illuminate\Http\Response
     */
    public function show(userinfo $userinfo)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\userinfo  $userinfo
     * @return \Illuminate\Http\Response
     */
    public function edit(userinfo $userinfo)
    {
        //
        return view('userinfo.edit',compact('userinfo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\userinfo  $userinfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, userinfo $userinfo)
    {
        //

        //request updating 
       $userinfo->update($request->all());    

        

         //request updating for new image 
         $picInfo=$request->file('newimage');   
         
         if($picInfo){

            $updatedID=$request->userinfo->id;
            $UserImageInfo=userinfo::where('id',$updatedID)->first();
            $exist_pic=$UserImageInfo->image;

            //checking existing image 
            if(file_exists($exist_pic)){           
             unlink($exist_pic);
            }           


          $picName=$updatedID.$picInfo->getClientOriginalName();

            $path="userImage/";
            $picUrl=$path.$picName;
            $picInfo->move($path,$picName);   

            $savepicUrl=$path.$picName;
            $updateuserimage=userinfo::find($updatedID);
            $updateuserimage->image=$savepicUrl;
            $updateuserimage->save();      


           }        



          return redirect()->route('userinfo.index')
                        ->with('success','User updated successfully');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\userinfo  $userinfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(userinfo $userinfo)
    {
        //request  for checking existing image 
            $deletedID=$userinfo->id;
            $UserdeleteInfo=userinfo::where('id',$deletedID)->first();
            $exist_pic=$UserdeleteInfo->image;

            if(file_exists($exist_pic)){           
             unlink($exist_pic);
            }      
        //user deleted
        $userinfo->delete();
        return redirect()->route('userinfo.index')
                        ->with('success','User deleted successfully');
    }
}
