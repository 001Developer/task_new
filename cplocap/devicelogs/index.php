<?php

@session_start();

include("../../common/config.php");

include("../../common/app_function.php");



if($_SESSION['username']=="")

{

	displayerror("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Login,../index.php", 0);

	exit();

}

$flag=$_GET['flag'];






admin_header('../../','Device Logs'." ",$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin);

admin_nav('../../','Device Logs'.' ',$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin,$connection, $cur_moduel);

?>



	

<div class="col-md-9 col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main" ng-app="myApp" ng-controller="customersCrtl">	



	<div class="row">

		<a href="../home.php" title="Back"><div class="frt"><i class="fa fa-arrow-circle-left fa-3x "></i></div></a>

		<ol class="breadcrumb">

<li><a href="../home.php"><i class="fa fa-home fa-2x fa-fw" aria-hidden="true"></i></a></li>

		<li class="active"><?php echo 'Device Logs'; ?></li>

		</ol>

	</div><!--/.row-->

	<div style="height: 40px;"></div>

	<div class="row">



        <div class="col-md-offset-2 col-md-8">

			<div class = "panel panel-primary">

				<div class = "panel-heading" style="height: 40px;">

					<h3 class = "panel-title " ><i class="fa fa-search fa-fw" aria-hidden="true"></i>Search</h3>

				</div>



			<div class="panel-body">



				<form  class="form-horizontal">

					<div class="form-group">

						<label class="control-label col-sm-4">Device Id :</label>

						<div class="col-sm-6">

							

						  <input type="text" name="deviceid" id="deviceid" class="form-control">

								

							

           

						</div>

					</div>



					



					<div class="form-group">

						<label class="control-label col-sm-4">&nbsp;</label>

						<div class="col-sm-6">

							<input type="button" ng-click='search()' value="Search" class="btn btn-primary" />

						</div>

					</div>

					</div>

				 </form>

			</div>

		</div>

        

	</div><!--/.row-->



  <div class="row">



		<div class="col-lg-12">

		
		

		<div class="panel-body">

			<table class="table table-bordered" ng-show="filteredItems > 0">

				<thead>

					<tr>

						<th>Sr No.</th>

						<th>Device Id</th>	

						<th>Power Type</th>	
						<th>Description</th>
						
						<th>Event Date</th>	
						<th>Added On</th>	

					</tr>

				</thead>

				<tbody>

					<tr ng-repeat="data in totalItems = (list | orderBy : predicate :reverse) | startFrom:(currentPage-1)*entryLimit | limitTo:entryLimit">

						<td>{{ data.count }}</td>

						<td>{{ data.deviceid}}</td>

						<td>{{ data.powertype}}</td>

						<td>{{ data.description}}</td>

						<td>{{ data.event}}</td>

						<td>{{ data.added}}</td>

					</tr>

				</tbody>

			</table>

			

			<div class="col-md-12" ng-show="filteredItems == 0">

				<h4>No Record found.</h4>

			</div>



			<div class="col-md-12" ng-show="filteredItems > 0">

				<div pagination="" page="currentPage" on-select-page="setPage(page)" boundary-links="true" total-items="filteredItems" items-per-page="entryLimit" class="pagination-small" previous-text="&laquo;" next-text="&raquo;">

				</div>

			</div>





		</div>



	</div><!--/.row-->	



</div><!--/.main-->

<script src="../../js/angular.min.js"></script> 

<script src="../../js/ui-bootstrap-tpls-0.10.0.min.js"></script> 

<script>

var app = angular.module('myApp', ['ui.bootstrap']);



app.filter('startFrom', function() {

    return function(input, start) {

        if(input) {

            start = +start; //parse to int

            return input.slice(start);

        }

        return [];

    }

});

app.controller('customersCrtl', function ($scope, $http, $timeout) {





	$http.get('fetch.php').success(function(data){

        //alert(data);

		$scope.list = data;

        $scope.currentPage = 1; //current page

        $scope.entryLimit = <?php echo $number_of_records_in_row; ?> //max no of items to display in a page

        $scope.filteredItems = $scope.list.length; //Initially for no filter  

        $scope.totalItems = $scope.list.length;

    });

	$scope.search= function(){

	var searchval1= document.getElementById('deviceid').value;

	// var searchval2= document.getElementById('sub').value;

	

    $http.get("fetch.php?deviceid="+searchval1).success(function(data){

        //alert(data);

		$scope.list = data;

        $scope.currentPage = 1; //current page

        $scope.entryLimit = <?php echo $number_of_records_in_row; ?>; //max no of items to display in a page

        $scope.filteredItems = $scope.list.length; //Initially for no filter  

        $scope.totalItems = $scope.list.length;

    });

	};

	

    $scope.setPage = function(pageNo) {

        $scope.currentPage = pageNo;

    };

    $scope.filter = function() {

        $timeout(function() { 

            $scope.filteredItems = $scope.filtered.length;

        }, <?php echo $number_of_records_in_row; ?>);

    };

    $scope.sort_by = function(predicate) {

        $scope.predicate = predicate;

        $scope.reverse = !$scope.reverse;

    };

	

});



app.controller('dropdown', function ($scope, $http, $timeout) {

	

});

</script>

<?admin_footer();?>