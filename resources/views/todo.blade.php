<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container mt-3">
  <h3>Modal Example</h3>
  <p>Click on the button to open the modal.</p>
  
  <button type="button" class="btn btn-primary addTodo" title="Add Todo" data-bs-toggle="modal" data-bs-target="#myModal">
    Add To-Do
  </button>
</div>

<!-- The Modal -->
<div class="container">
    <div class=" text-center">
        <table class="table table-bordered list_todo">
            
                <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Action</th>
                    </tr>
                   
                </thead>
            <tbody>
               
                @foreach ($todos as $key=>$todo)   
                <tr id="remove_{{$todo->id}}">
                <td>{{$key+1}}</td>
                <td>{{$todo->name}}</td>
                <td>{{$todo->mobile}}</td>
                <td>
                    <button type="button" data-id="{{$todo->id}}" class="btn btn-sm btn-info editTodo">Edit</button>
                    <button type="button" data-id="{{$todo->id}}" class=" btn btn-sm btn-danger deleteTodo">Delete</button>
                </td>  
              </tr>  
                @endforeach
           
            </tbody>
         
           
            
        </table>
    </div>

</div>

<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title" id="titleTodo"></h4>
      </div>
      <form id="formTodo" action="{{route('todo.store')}}" method="post">
      <!-- Modal body -->
      {{ csrf_field() }}
      <div class="modal-body  text-justify-center text-bold">
            <input type="hidden" name="todo_id" id="todoId">
            <label>Name</label>
            <input type="text" class="my-2" name="name" id="name"/></br>
            <label>Mobile</label>
            <input type="text" class="my-2" name="mobile" id="mobile"/>
      
      </div>
      <!-- Modal footer -->
      <div class="modal-footer">
        <input type="submit" name="submit" value="" class="btn btn-info submit_todo">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>
    </form>
    </div>
  </div>
</div>


</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    
    $('.addTodo').click(function(){
        $('.submit_todo').val('Create');
        $('#titleTodo').text('Add Todo');
        $('#formTodo').trigger('reset');
   });

   $('.editTodo').click(function(){
        var id = $(this).data('id');
        $.get("{{url('todo')}}/"+id+"/edit", function (data, status) {
            $('#name').val(data.name);
            $('#mobile').val(data.mobile);
            $('#titleTodo').text('Edit Todo');
            $('.submit_todo').val('Update');
            $('#myModal').modal('show'); 
            $('#todoId').val(id);
        });
   });

   $('.deleteTodo').click(function(){
       var id =$(this).data('id');
       if(confirm(" are you sure want to delete !")){
            $.ajax({
            type:"DELETE",
            url:"{{url('todo')}}/"+id,
            data:"_token={{csrf_token()}}",
            success: function (data) {
                    $('#remove_'+id).remove();
                }
        });
       }
   });

});


</script>
