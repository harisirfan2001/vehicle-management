@extends('layouts.master')
@section('title', 'Add Part')
@section('content')

<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Parts</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add Parts</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <button type="button" class="btn"><a href="{{route('partindex')}}" class="btn btn-light">View Parts</a></button>

                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <!--start stepper one-->

        <h6 class="text-uppercase">Add Part </h6>
        <hr>
        <div id="stepper1" class="bs-stepper ">
           
            <div class="card ">
                <div class="card-body">
                    <div class="bs-stepper-content">
                        <form onSubmit="return false">
                            <div id="test-l-2" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger2">

                                <h5 class="mb-1">Add Part</h5>
                                <div class="row g-3">
                                    <div class="row g-3">
                                        <div class="col-12 col-lg-4">
                                            <label for="InputUsername" class="form-label"> Picture  </label>
                                            <input type="file" class="form-control">
                                        
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <label for="InputEmail2" class="form-label"> Vendor </label>
                                             
                                            <select class="form-select" id="InputCountry" aria-label="Default select example">
                                                <option selected>---</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <label for="InputPassword" class="form-label">   Parts Category</label>
                                            <select class="form-select" id="InputCountry" aria-label="Default select example">
                                                <option selected>---</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                        </div>
                                    </div>
                                     <div class="row g-3">
                                        <div class="col-12 col-lg-4">
                                            <label for="InputCountry" class="form-label"> Barcode</label>
                                            <input type="text" class="form-control" placeholder="Barcode" >
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <label for="InputCountry" class="form-label">Title </label>
                                            <input type="text" class="form-control">
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <label for="InputCountry" class="form-label">Manufacturer</label>
                                             <input type="text" class="form-control">
                                           
                                        </div>
                                    </div> 
                                     <div class="row g-3">
                                        <div class="col-12 col-lg-4">
                                            <label for="InputCountry" class="form-label">Number</label>
                                              <input type="text" class="form-control" placeholder=" Number">
							                   
						
                                            
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <label for="InputCountry" class="form-label">Year</label>
                                           <select class="form-select" id="InputCountry" aria-label="Default select example">
                                                <option value="2">2024</option>
                                                <option value="3">2023</option>
                                            </select>

                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <label for="InputCountry" class="form-label"> Description</label>
                                            <textarea class="form-control" rows="1"></textarea>
                                        </div>
                                    </div> 
                                     <div class="row g-3">
                                        <div class="col-12 col-lg-4">
                                            <label for="InputCountry" class="form-label"> Model</label>
                                            <input type="text" class="form-control" placeholder="Model">

                                           
                                        </div> 
                                         <div class="col-12 col-lg-4">
                                            <label for="InputCountry" class="form-label">Status</label>
                                          
                                            <select class="form-select" id="InputCountry" aria-label="Default select example">
                                                <option selected>Completed</option>
                                                <option value="1">active</option>
                                                <option value="2">Pending</option>
                                                <option value="3">Processing</option>
                                                <option value="3">Hold</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <label for="InputCountry" class="form-label">Qty on Hand  </label>
                                            <input type="text" class="form-control">
                                            
                                        </div> 
                                     </div> 
                                     <div class="row g-3">
                                        <div class="col-12 col-lg-4">
                                            <label for="InputCountry" class="form-label">Unit Cost</label>
                                            <input type="text" class="form-control">

                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <label for="InputCountry" class="form-label"> Add User defined field</label>
                                            <input type="text" class="form-control">

                                            
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <label for="InputCountry" class="form-label">Note</label>
                                            <textarea class="form-control" rows="1"></textarea>
                                           

                                        </div>
                                    </div> 
                                  
                                    <div class="col-12">
                                        <div class="d-flex align-items-center gap-3">
                                           
                                            <button class="btn btn-light px-4">Save part</button>
                                        </div>
                                    </div>

                                </div>

                        </form>
                    </div>

                </div>
            </div>
           
        </div>
 
       
    </div>
</div>




@endsection