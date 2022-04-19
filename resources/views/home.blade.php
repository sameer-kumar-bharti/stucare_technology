@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div id="">
                        
                        <h3>Company (CURD with Api)</h3>
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Contact</th>
                                <th scope="col">website</th>
                                <th scope="col">logo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=0;  ?>
                                @foreach($company as $key)
                                <?php $i++;  ?>
                                <tr>
                                    <th scope="row">{{$i}}</th>
                                    <td>{{$key->name}}</td>
                                    <td>{{$key->email}}</td>
                                    <td>{{$key->contact}}</td>   
                                    <td>{{$key->website}}</td>   
                                    <td>
                                        <img src="{{asset('upload')}}/{{$key->logo}}" style="height:30px;width:50px;" />
                                    </td>   
                                </tr>
                                @endforeach
                            </tbody>
                            </table>
                    </div>
                    <div id="">
                        <!--<a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#employeeadd">Add new employee</a>-->
                        <button type="button" class="btn btn-primary show_add_employee">Add new employee</button>
                        <h3>Employee</h3>
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">company</th>
                                <th scope="col">email</th>
                                <th scope="col">phone</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="employee_table">
                            
                            </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--add employee modal -->



<!-- Modal -->
<div class="modal fade" id="employeeadd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add new employee</h5>
       
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="employeeform">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">First name<span style="color:red;">*</span></label>
                <input type="text" class="form-control" id="first_name" name="first_name" aria-describedby="" >
                
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Last name<span style="color:red;">*</span></label>
                <input type="text" class="form-control" id="last_name" name="last_name" aria-describedby="" >
                
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Company<span style="color:red;">*</span></label>
                <select class="form-control" id="company" name="company">
                    <option value="">Select company</option>
                @foreach($company as $key)
                    <option value="{{$key->id}}">{{$key->name}}</option>
                @endforeach
                </select>
                
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Email<span style="color:red;">*</span></label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Phone<span style="color:red;">*</span></label>
                <input type="email" class="form-control" id="phone" name="phone">
            </div>
            <button type="button" class="btn btn-primary add_employee">Submit</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>


<!--edit employee modal -->



<!-- Modal -->
<div class="modal fade" id="editemployee" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit employee</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form >
            @csrf
            <input type="hidden" value="" id="hidden_id">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">First name</label>
                <input type="text" class="form-control" id="first_name1" name="first_name" aria-describedby="" required>
                
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Last name</label>
                <input type="text" class="form-control" id="last_name1" name="last_name" aria-describedby="" required>
                
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Company</label>
                <select class="form-control" id="company1" name="company" required>
                @foreach($company as $key)
                    <option value="{{$key->id}}">{{$key->name}}</option>
                @endforeach
                </select>
                
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Email</label>
                <input type="email" class="form-control" id="email1" name="email" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Phone</label>
                <input type="email" class="form-control" id="phone1" name="phone" required>
            </div>
            <button type="button" class="btn btn-primary edit_employee">Submit</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>
@endsection
