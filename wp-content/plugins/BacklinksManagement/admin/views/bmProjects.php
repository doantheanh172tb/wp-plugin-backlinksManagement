<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!-- Optional theme -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" />

<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css" />

<link rel="stylesheet" href="../wp-content/plugins/BacklinksManagement/admin/static/css/bm-style.css" />

<br/>
<div class="clearfix"></div>

<div class"bm-content-box">

  <ul class="nav nav-pills">
    <li class="nav-item">
      <div class="btn-group nav-link" id="actionForChecked">
        <button disabled type="button" class="btn btn-danger">
          <span class="glyphicon glyphicon-check"></span>
            Selected
          <span id="countSelected" class="label label-primary pull-right">0</span>
        </button>
        <button disabled type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="glyphicon glyphicon-chevron-down  "></span>
        </button>
        <ul class="dropdown-menu nav flex-column">
          <li class="nav-item">
            <a class="nav-link active">Deleted</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#">Disabled</a>
          </li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Link</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Link</a>
    </li>
    <li class="nav-item pull-right">
      <button type="button" class="btn btn-primary" 
        data-toggle="modal" data-target="#addoreditProject" data-id="">
          Add Project
      </button>
    </li>
  </ul>

  <div class="clearfix"></div>
  <br/>

    <table class="display hover bm-table-select" id="table-projects">
      <thead>
        <tr>
            <th>
              <div class="checkbox checkbox-warning" id="checkAllIcon">
                  <img id='uncheckAllRow' class='checkboxIcon' src='../wp-content/plugins/BacklinksManagement/admin/static/img/uncheckedIcon.png' alt='uncheckedIcon'>
              </div>
            </th>
            <th>Project Url</th>
            <th>Project Name</th>
            <th>Project Description</th>
            <th>Action</th>
        </tr>
      </thead>
    </table>
    <button class="btn btn-outline-success my-2 my-sm-0" id="dkmm" type="">Search</button>
</div>















<div class="modal fade" id="addoreditProject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">modal-title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="addOrEditProjectForm">
          <input id="pId" type="hidden" class="modal-pId" name="id">
          <div class="form-group">
            <label for="pUrl" class="col-form-label">Project Url:</label>
            <input id="pUrl" type="text" class="form-control modal-pUrl" name="url">
          </div>
          <div class="form-group">
            <label for="pName" class="col-form-label">Project Name:</label>
            <input id="pName" type="text" class="form-control modal-pName" name="name">
          </div>
          <div class="form-group">
            <label for="pDesc" class="col-form-label">Project Description:</label>
            <textarea id="pDesc" class="form-control modal-pDesc" name="description"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="addOrEditProjectBtn" >Save</button>
      </div>
    </div>
  </div>
</div>


<div class="modal" tabindex="-1" role="dialog" id="cf-deleteProject">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Comfrim Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Ready?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btnDeleteOneProject">Delete</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>

<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.2/js/dataTables.buttons.min.js">></script>

<script src="../wp-content/plugins/BacklinksManagement/admin/static/js/bm-tableScript.js"></script>
<script src="../wp-content/plugins/BacklinksManagement/admin/static/js/bm-modalScript.js"></script>

<script>

</script>