<!-- Script for users data table -->
<script>

    // Tooltip
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });

    // Script for users view in data table
    $(document).ready(function(){
        $('#users_dataTable').DataTable({
            pageLength: 10,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                {extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel', title: 'ExampleFile'},
                {extend: 'pdf', title: 'ExampleFile'},

                {extend: 'print',
                 customize: function (win){
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                }
                }
            ]
        });

        //In-Active User By Admin Toggle(Yes/No)
        $('[data-toggle="inactive_confirmation"]').confirmation({

            onConfirm: function(){
                    var user_id = $(this).attr('data-id');
                    window.location.href = "<?= base_url();?>User/active_inactive/"+user_id+"/0";
            }, // Set event when click at confirm button

            onCancel: function(){
                    var user_id = $(this).attr('data-id');
            }
        });

        //Delete Food Category
        $('[data-toggle="food_category_delete_confirmation"]').confirmation({

            onConfirm: function(){
                    var id = $(this).attr('data-id');
                    window.location.href = "<?= base_url();?>Admin/delete_food_category/"+id;
            }, // Set event when click at confirm button

            onCancel: function(){
                    var user_id = $(this).attr('data-id');
            }
        });

        //Delete Blog
        $('[data-toggle="blog_delete_confirmation"]').confirmation({

            onConfirm: function(){
                    var id = $(this).attr('data-id');
                    window.location.href = "<?= base_url();?>Admin/delete_blog/"+id;
            }, // Set event when click at confirm button

            onCancel: function(){
                    var user_id = $(this).attr('data-id');
            }
        });

        //Active User By Admin Toggle(Yes/No)
        $('[data-toggle="active_confirmation"]').confirmation({

            onConfirm: function(){
                    var user_id = $(this).attr('data-id');
                    window.location.href = "<?= base_url();?>User/active_inactive/"+user_id+"/1";
            }, // Set event when click at confirm button

            onCancel: function(){
                    var user_id = $(this).attr('data-id');
            }
        });

        //Delete Food Listing By Admin Toggle(Yes/No)
        $('[data-toggle="food_delete_confirmation"]').confirmation({

            onConfirm: function(){
                    var id = $(this).attr('data-id');
                    window.location.href = "<?= base_url();?>Food_Listings/delete_listing/"+id;
            }, // Set event when click at confirm button

            onCancel: function(){
                    var user_id = $(this).attr('data-id');
            }
        });

        // Match Old Password
        $(document).on("blur", "#old_password", function(){
            var old_password = $("#old_password").val();
            $.ajax({

                url:"<?= base_url(); ?>user/match_old_password",
                type:"POST",
                data:{ old_password : old_password},
                success: function(data){
                    if(data == 1)
                    {
                        $("#all_field_required").hide();
                        $('#new_password').prop('disabled', false);
                        $('#confirm_password').prop('disabled', false);
                    }
                    else
                    {
                        $('#new_password').prop('disabled', true);
                        $('#confirm_password').prop('disabled', true);
                        $("#all_field_required").html("Old Password is can not matched.");
                        $("#all_field_required").show("");
                    }
                }
            });
        });

        // Script for update password after login
        $("#update_password").click(function(){

            // Get all password values
            var old_pass = $("#old_password").val();
            var new_pass = $("#new_password").val();
            var con_pass = $("#confirm_password").val();

            // check if any password field is blank
            if(old_pass != '' && new_pass != '' && con_pass != '')
            {
                // remove error message
                $("#all_field_required").html("");
                $("#all_field_required").hide("");

                // check new password and confirm password is same or not
                if(new_pass === con_pass)
                {
                    $.ajax({
                        url : "<?= base_url(); ?>auth/change_password",
                        type : "POST",
                        data : {old_pass : old_pass, new_pass : new_pass},
                        success : function(result)
                        {
                            if(result == 0)
                            {
                                $("#all_field_required").html("Old Password is Wrong !");
                                $("#all_field_required").show("");
                            }
                            else if(result == 1)
                            {
                                $("#all_field_required").removeClass("alert-danger");
                                $("#all_field_required").addClass("alert-success");
                                $("#all_field_required").html("Password Updated successfully.");
                                $("#all_field_required").show("");

                                //Blank all field and close model
                                setTimeout(function()
                                {
                                    $('#change_pass_form input').val("");
                                    $("#myModal").modal('hide');
                                    $("#all_field_required").hide("");
                                    $("#all_field_required").removeClass("alert-success");
                                    $("#all_field_required").addClass("alert-danger");
                                }
                                ,2500);
                            }
                        }
                    });
                }
                else    // if new password and confirm password is not same
                {
                    $("#all_field_required").html("Confirm Passwords did not match !");
                    $("#all_field_required").show("");
                }
            }
            else    // if any field is blank
            {
                $("#all_field_required").html("All fields are required !");
                $("#all_field_required").show("");
            }
        });
    });

    // Scripts for charts on dashboard || Notification on page reload || Or else
    $(document).ready(function() {

        /*setTimeout(function() {
            toastr.options = {
                closeButton: true,
                progressBar: true,
                showMethod: 'slideDown',
                timeOut: 4000
            };
            toastr.success('Welcome to Khao SAA');

        }, 1300);*/

       var data1 = [
            [0,4],[1,8],[2,5],[3,10],[4,4],[5,16],[6,5],[7,11],[8,6],[9,11],[10,30],[11,10],[12,13],[13,4],[14,3],[15,3],[16,6]
        ];
        var data2 = [
            [0,1],[1,0],[2,2],[3,0],[4,1],[5,3],[6,1],[7,5],[8,2],[9,3],[10,2],[11,1],[12,0],[13,2],[14,8],[15,0],[16,0]
        ];
        $("#flot-dashboard-chart").length && $.plot($("#flot-dashboard-chart"), [
            data1, data2
        ],
                {
                    series: {
                        lines: {
                            show: false,
                            fill: true
                        },
                        splines: {
                            show: true,
                            tension: 0.4,
                            lineWidth: 1,
                            fill: 0.4
                        },
                        points: {
                            radius: 0,
                            show: true
                        },
                        shadowSize: 2
                    },
                    grid: {
                        hoverable: true,
                        clickable: true,
                        tickColor: "#d5d5d5",
                        borderWidth: 1,
                        color: '#d5d5d5'
                    },
                    colors: ["#1ab394", "#1C84C6"],
                    xaxis:{
                    },
                    yaxis: {
                        ticks: 4
                    },
                    tooltip: false
                }
        );

        var doughnutData = {
            labels: ["App","Software","Laptop" ],
            datasets: [{
                data: [300,50,100],
                backgroundColor: ["#a3e1d4","#dedede","#9CC3DA"]
            }]
        } ;

        var doughnutOptions = {
            responsive: false,
            legend: {
                display: false
            }
        };

        var ctx4 = document.getElementById("doughnutChart").getContext("2d");
        new Chart(ctx4, {type: 'doughnut', data: doughnutData, options:doughnutOptions});

        var doughnutData = {
            labels: ["App","Software","Laptop" ],
            datasets: [{
                data: [70,27,85],
                backgroundColor: ["#a3e1d4","#dedede","#9CC3DA"]
            }]
        } ;

        var doughnutOptions = {
            responsive: false,
            legend: {
                display: false
            }
        };

        var ctx4 = document.getElementById("doughnutChart2").getContext("2d");
        new Chart(ctx4, {type: 'doughnut', data: doughnutData, options:doughnutOptions});

    });

</script>