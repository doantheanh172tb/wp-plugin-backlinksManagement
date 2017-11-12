$(document).ready(function () {
    var table = {};
    var uncheckIcon = "<img class='checkboxIcon' src='../wp-content/plugins/BacklinksManagement/admin/static/img/uncheckedIcon.png' alt='Girl in a jacket'>";
    var checkedIcon = "<img class='checkboxIcon' src='../wp-content/plugins/BacklinksManagement/admin/static/img/checkedIcon.png' alt='Girl in a jacket'>";

    var uncheckAllRowIcon = "<img id='uncheckAllRow' class='checkboxIcon' src='../wp-content/plugins/BacklinksManagement/admin/static/img/uncheckedIcon.png' alt='uncheckedIcon'>";
    var checkedAllRowIcon = "<img id='checkedAllRow' class='checkboxIcon' src='../wp-content/plugins/BacklinksManagement/admin/static/img/checkedIcon.png' alt='checkedIcon'>";

    try {
        table = $('#table-projects').DataTable({
            "ajax": 'http://localhost/wpBacklinkManagement/wp-json/api-bm/allProject',
            "columns": [
                null,
                { "data": "url" },
                { "data": "name" },
                { "data": "description" },
                { "data": "id" }
            ],
            "columnDefs": [
                {
                    "targets": 0,
                    "searchable": false,
                    "orderable": false,
                    "className": "dt-center checkItem",
                    "render": function () {
                        return "<div class='checkbox checkbox-warning datatableCheckbox'>"
                            + uncheckIcon
                            + "</div>";
                    }
                },
                {
                    "targets": 4,
                    "searchable": false,
                    "orderable": false,
                    "className": "dt-center",
                    "render": function (id) {
                        // console.log('id', id);
                        return "<div class='btn-group'>"
                            + "<button data-id='" + id + "' type='button' class='btn btn-primary deleteOneProject'>Delete</button>"
                            + "<button data-id='" + id + "' type='button' class='btn btn-primary'"
                            + "data-toggle='modal' data-target='#addoreditProject''>Edit</button>"
                            + "</div>";
                    }
                }
            ]
        });
    } catch (error) {
        console.log(error)
    } finally {
        $('#table-projects tbody').on('click', 'td.checkItem', function () {

            var row = $(this).parent();
            row.toggleClass('selected');

            var datatableCheckbox = row.find($('.datatableCheckbox'));

            console.log(row.hasClass("selected"));
            if (row.hasClass("selected")) {
                console.log("checked")
                datatableCheckbox[0].innerHTML = checkedIcon;
            } else {
                console.log("unchecked")
                datatableCheckbox[0].innerHTML = uncheckIcon;
            }

            updateCountSelected();
        });


        // $('#dkmm').click(function () {
        //     alert(table.rows('.selected').data().length + ' row(s) selected');
        // });

        $(document).on("click", "#uncheckAllRow", function () {
            uncheckAllRow();
        })

        $(document).on("click", "#checkedAllRow", function () {
            checkedAllRow();
        })

        function uncheckAllRow(params) {
            console.log("uncheckAllRow")
            var cells = $('.checkbox', table.rows().nodes());
            // console.log(cells)
            cells.each(function (i, obj) {
                console.log(obj);
                obj.innerHTML = checkedIcon;
                $(obj).parent().parent().addClass("selected");
            });

            document.getElementById("checkAllIcon").innerHTML = checkedAllRowIcon;
            updateCountSelected();
        }

        function checkedAllRow() {
            console.log("checkedAllRow")
            var cells = $('.checkbox', table.rows().nodes());
            // console.log(cells)
            cells.each(function (i, obj) {
                console.log(obj);
                obj.innerHTML = uncheckIcon;
                $(obj).parent().parent().removeClass("selected");
            });

            document.getElementById("checkAllIcon").innerHTML = uncheckAllRowIcon;
            updateCountSelected();
        }

        function resetCheckAll() {
            document.getElementById("checkAllIcon").innerHTML = uncheckAllRowIcon;
            document.getElementById("countSelected").innerHTML = "0";
            $("#actionForChecked button").prop('disabled', true);
        }


        function resetDataProjectForm(modal, dataProject) {
            if (dataProject) {
                console.log("dataProject not null")
                modal.find('.modal-title').text('Edit Project');
                modal.find('.modal-pId').val(dataProject.id);
                modal.find('.modal-pName').val(dataProject.name);
                modal.find('.modal-pUrl').val(dataProject.url);
                modal.find('.modal-pDesc').val(dataProject.description);
            } else {
                console.log("dataProject null")
                modal.find('.modal-title').text('New Project');
                modal.find('.modal-pId').val('');
                modal.find('.modal-pName').val('');
                modal.find('.modal-pUrl').val('');
                modal.find('.modal-pDesc').val('');
            }
        }



        function countSelected() {
            // console.log(table);
            alert('Rows ' + table.rows('.selected').count() + ' are selected');
            return table.rows('.selected').data().length;
        }

        function updateCountSelected() {
            var count = countSelected();
            console.log(count);
            $("span#countSelected").text(count);

            if (count > 0) {
                console.log(">0")
                $("#actionForChecked button").prop('disabled', false);
                console.log(">0 222")
                document.getElementById("checkAllIcon").innerHTML = checkedAllRowIcon
                console.log(">0 3333")
            } else {
                console.log("<=0")
                $("#actionForChecked button").prop('disabled', true);
                document.getElementById("checkAllIcon").innerHTML = uncheckAllRowIcon;
            }
        }


        $('#addoreditProject').on('show.bs.modal', function (event) {
            console.log("addNewProject::model::show")
            var button = $(event.relatedTarget) // Button that triggered the modal
            var project_id = button.data('id') // Extract info from data-* attributes

            // var project = null;
            var modal = $(this);

            if (project_id) {
                console.log("edit project");
                $.ajax({
                    url: "http://localhost/wpBacklinkManagement/wp-json/api-bm/projectForm?id=" + project_id,
                    success: (function (data) {
                        console.log("ajaxProjectData", data);
                        console.log("ajaxProjectDataId", data.id);
                        resetDataProjectForm(modal, data);
                    }),
                });
                console.log("done edit project");
            } else {
                console.log("add new project");
                resetDataProjectForm(modal, null);
            }

            // // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            // var modal = $(this)
            // modal.find('.modal-title').text('New message to ' + recipient)
            // modal.find('.modal-body input').val(recipient)
        })


        $(document).on("click", "#addOrEditProjectBtn", function () {
            console.log($('#addOrEditProjectForm').serialize());
            $.post('http://localhost/wpBacklinkManagement/wp-json/api-bm/addOrEditProject',
                $('#addOrEditProjectForm').serialize()
            )
                .done(function (data) {
                    if (data.success) {
                        var p1 = new Promise(
                            function (resolve, reject) {
                                table.ajax.reload(null, false);
                            }
                        );
                        p1.then(
                            $('#addoreditProject').modal('hide')
                        ).catch(
                            function (reason) {
                                console.log('catch');
                            })
                            .then(resetCheckAll())
                    }
                });
        })

        $(document).on("click", ".deleteOneProject", function () {
            var pId = $(this).data("id");
            $("#cf-deleteProject").modal('show');
            document.getElementById('btnDeleteOneProject').setAttribute('data-id', pId);
            // plant.setAttribute('data-id', pId);

            document.getElementById('btnDeleteOneProject').onclick = function (btnDeleteOneProject) {
                // alert(plant.getAttribute('data-id'));
                $.post('http://localhost/wpBacklinkManagement/wp-json/api-bm/deleteProject',
                    { "id": pId }
                )
                    .done(function (data) {
                        if (data.success) {
                            var p1 = new Promise(
                                function (resolve, reject) {
                                    table.ajax.reload(null, false);
                                    resolve();
                                }
                            );
                            p1.then(function () {
                                console.log("then");
                                $('#cf-deleteProject').modal('hide')
                            }).catch(
                                function (reason) {
                                    console.log('catch');
                                })
                                .then(resetCheckAll())
                        }
                    });

            };
        })

    }




    // $("#addoreditProject").on("hidden.bs.modal", function () {
    //     console.log("addNewProject::model::hidden")
    //     // $(".modal-body").html("");
    // });


});




