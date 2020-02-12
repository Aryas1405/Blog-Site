@extends('layouts.master_layout')

@section('content')
<head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
</head>
<div class="row">
    <div class="fb-profile">
        <div class="fb-profile-text">
            <h3>{{$user->name}}</h3>
            
        </div>
    </div>
  </div>
</div> <!-- /container fluid-->  

  <div class="col-sm-8">

      <div data-spy="scroll" class="tabbable-panel">
        <div class="tabbable-line">
          <ul class="nav nav-tabs ">
            <li class="active">
              <a href="#tab_default_1" data-toggle="tab">
              About {{$user->name}} </a>
            </li>
            <li>
              <a href="#tab_default_2" data-toggle="tab">
              {{$user->name}}'s Blogs</a>
            </li>
            <li>
              <a href="#tab_default_3" data-toggle="tab">
              {{$user->name}}'s Roles</a>
            </li>
             <li>
              <a href="#tab_default_4" data-toggle="tab">
              {{$user->name}}'s permissions</a>
            </li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab_default_1">
 
              <p>
                My daughter  is good looking, with pleasant personality, smart, well educated, from well cultural and  a religious family background. having respect in heart for others.  
                would like to thanks you for visiting through my daughter;s profile. 
                She has done PG in Human Resources after her graduation. 
                At present working IN INSURANCE sector as Manager Training .
              </p>
              <h4>About her Family</h4>
              <p>
                About her family she belongs to a religious and a well cultural family background. 
                Father - Retired from a Co-operate Bank as a Manager. 
                Mother - she is a home maker. 
                1 younger brother - works for Life Insurance n manages cluster. 
              </p>
              <h4>Education </h4>
              <p>I have done PG in Human Resourses</p>
              <h4>Occupation</h4>
              <p>At present Working in Insurance sector</p>
           
            </div>
            <div class="tab-pane" id="tab_default_2">
             
              <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="blog">Blogs:</label>
                        <p>
                        
                        </p>
                    </div>
                </div>
             
              </div>

             
           
            </div>
            <div class="tab-pane" id="tab_default_3">
            
              <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="email">Roles</label>
                        <p> MBA/PGDM</p>
                    </div>
                </div>
              
              </div>
            </div>

            <div class="tab-pane" id="tab_default_4">
          
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="email">Permissions:</label>
                            <p> MBA/PGDM</p>
                        </div>
                    </div>
                </div>

            </div>

            </div>
          </div>
        </div>
      </div>
  
  </div>
  <div class="col-sm-4">
   <div class="panel panel-default">
    <div class="menu_title">
       Horoscope
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                 <div class="form-group">
                     <label for="email">Place of Birth:</label>
                      <p> pune, maharashtra</p>
                 </div>
                  <div class="form-group">
                      <label for="email">Date of Birth:</label>
                      <p> 26 Sep 2017</p>
                  </div>
                  <div class="form-group">
                      <label for="email">Time of Birth:</label>
                      <p> 11:20 min.</p>
                  </div>
                   <div class="form-group">
                      <label for="email">Horroscoe Match not Necessory</label>
                   </div>
                    <div class="form-group">
                      <label for="email">Sun Sign:</label>
                      <p> Scorpio</p>
                    </div>
                    <div class="form-group">
                      <label for="email">Rashi/ Moon sign:</label>
                      <p> Mesh</p>
                    </div>
                     <div class="form-group">
                      <label for="email">Nakshtra:</label>
                      <p> Bharani</p>
                    </div>
                      <div class="form-group">
                      <label for="email">Manglik:</label>
                      <p> Manglik</p>
                    </div>
                <button type="submit" class="btn btn-danger btn-block">Submit</button>
            </div>
        </div>
    </div>
</div>
@endsection