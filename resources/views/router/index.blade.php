@extends('layouts.app')

@section('css')
<style>
.hidden {
    display:none;
}
</style>
@endsection

@section('section')  
<div class="container">
    <div class="row">
    <div class="col-md-12">
    <div class="table-responsive">
    
    <button type="button" class="btn btn-primary mb-4 mt-4"  id="myBtn">Create Router</button>
    <div class="render_view">
        @include('router.table')
        {{ $routers->links() }}
    </div>
    </div>
    </div>
    </div>
    </div>

        <!-- The Modal -->
        <div class="modal fade" id="myModal">
        <div class="modal-dialog">
        <div class="modal-content">
        
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Router Details</h4>
            <button type="button" class="close" data-dismiss="modal">×</button>
            
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">
                <div class="alert alert-danger hidden" id="msg">
                </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Sap ID</label>
                                <input type="text" class="form-control" placeholder="Sap Id" name="sap_id" id="sap_id">
                            </div>
                            <label>Type</label>
                            <select class="custom-select form-group" name="type" id="type">
                                <option value="">--SELECT TYPE--</option>
                                <option value="AG1">AG1</option>
                                <option value="CSS">CSS</option>
                            </select>
                            <div class="form-group">
                                <label>Hostname</label>
                                <input type="text" class="form-control" placeholder="Hostname" name="host_name" id="host_name">
                            </div>
                            <div class="form-group">
                                <label>Loopback(ipv4)</label>
                                <input type="text" class="form-control" placeholder="Loopback" name="loopback" id="loopback">
                            </div>
                            <div class="form-group">
                                <label>Mac Address</label>
                                <input type="text" class="form-control" placeholder="Mac Address" name="mac_address" id="mac_address">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="update_route" class="update_route" name="update_route" value=""/>
                    <button type="button" id="add_router" class="btn btn-primary" value="add">Submit</button>      
                </div>
                <!-- Modal body -->
            </div>
        </div>
        </div>
    </div>
    @endsection

    @section('js')
    <script>
    $(document).ready(function(){
        //Add or Update
        $("#add_router").click(function() {
            var type = $("#add_router").val();
            var update_route =  '{{ url("router") }}/'+$("#update_route").val();
            var add_route = '{{ route("router.store")}}';
            $.ajax({
                type: type=='add' ? 'POST' : 'PUT',
                url: type=='add' ? add_route : update_route,
                data: {
                    'sap_id': $('#sap_id').val(),
                    'type': $('#type').val(),
                    'host_name': $('#host_name').val(),
                    'loopback': $('#loopback').val(),
                    'mac_address': $('#mac_address').val()
                },
                success: function(data) {
                    if(! data.status) {
                        $("#msg").text(data.message);
                        $("#msg").removeClass('hidden');
                        return false;
                    }
                    $("#msg").text('');
                    $("#msg").addClass('hidden');
                    $(".close").trigger('click');
                    swal("Success", data.message, "success").then((value) => {
                        location.reload();
                    });
                },
                error: function (data) {
                    swal("Something went wrong!");
                }
            });
        });

        //Delete
        $(".delete").click(function() {
            var route = $(this).attr('data-url');
            swal("Are you sure you want to delete this router?", {
                buttons: ["Cancel", true],
            }).then((value) => {
                if(value) {
                    $.ajax({
                    type: 'DELETE',
                    url: route,
                    success: function(data) {
                        if(! data.status) {
                            swal(data.message);
                            return false;
                        }
                        swal("Success", data.message, "success").then((value) => {
                            location.reload();
                        });
                    },
                    error: function (data) {
                        swal("Something went wrong!");
                    }
                });
                }
            });
        });

        //Edit
        $(".edit").click(function() {
            var route = $(this).attr('data-url');
            $.ajax({
                type: 'GET',
                url: route,
                success: function(data) {
                    if(! data.status) {
                        swal(data.message);
                        return false;
                    }
                    reset();
                    $("#add_router").val('update');
                    $("#add_router").text('Update');
                    $("#update_route").val(data.data.id);
                    $('#type').val(data.data.type);
                    $('#sap_id').val(data.data.sap_id);
                    $('#host_name').val(data.data.host_name);
                    $('#loopback').val(data.data.loopback);
                    $('#mac_address').val(data.data.mac_address);
                    $("#myModal").modal();
                    
                },
                error: function (data) {
                    swal("Something went wrong!");
                }
            });
        });

        // Modal
        function reset() {
            $("#msg").addClass('hidden');
            $("#type").val('');
            $('#sap_id').val('');
            $('#host_name').val('');
            $('#loopback').val('');
            $('#mac_address').val('');
        }

        $("#myBtn").click(function(){
            reset();
            $("#add_router").val('add');
            $("#add_router").text('Submit');
            $("#myModal").modal();
        });

    });
    </script>
    @endsection
