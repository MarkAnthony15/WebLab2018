<%-- 
    Document   : register
    Created on : Nov 24, 2018, 7:18:28 PM
    Author     : mark_
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@page import="java.sql.*"%>
<%@page import="javax.servlet.http.HttpSession" %>
<%
String driver = "com.mysql.jdbc.Driver";
String connectionUrl = "jdbc:mysql://localhost:3306/";
String database = "weblove-costumes";
String userid = "root";
String password = "";
try {
Class.forName(driver);
} catch (ClassNotFoundException e) {
e.printStackTrace();
}
Connection connection = null;
Statement statement = null;
ResultSet resultSet = null;
 
if (session.getAttribute( "Name" ) == null){
    response.sendRedirect("index.jsp");
}else {
%>

<%
try
{
	Class.forName("com.mysql.jdbc.Driver"); //load driver
	
	Connection con=DriverManager.getConnection("jdbc:mysql://localhost:3306/weblove-costumes","root",""); //create connection
	
	if(request.getParameter("btn_register")!=null) //check register button click event not null
	{
		String firstname,lastname,username,pass,cpass;
		
		firstname=request.getParameter("f_name"); //txt_firstname
		lastname=request.getParameter("l_name"); //txt_lastname
		username=request.getParameter("username"); //txt_email
		pass=request.getParameter("password"); //txt_password
                cpass=request.getParameter("cPassword");
		
		PreparedStatement pstmt=null; //create statement
		
		pstmt=con.prepareStatement("insert into administrator(firstname,lastname,username,password) values(?,?,?,?)"); //sql insert query
		pstmt.setString(1,firstname);
		pstmt.setString(2,lastname);
		pstmt.setString(3,username);
		pstmt.setString(4,pass);
		
		pstmt.executeUpdate(); //execute query
		
		request.setAttribute("successMsg","Register Successfully...! Please login"); //register success messeage

		con.close(); //close connection
	}
}
catch(Exception e)
{
	out.println(e);
}
%>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dacs Clothing</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    
    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
    
    <link rel="icon"  href="dacs.png">

  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="home.jsp">Dacs Clothing Services</a>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Navbar Search -->
      <div class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
          <div class="input-group-append">
          </div>
        </div>
      </div>
            <%
              try{
              connection = DriverManager.getConnection(connectionUrl+database, userid, password);
              statement=connection.createStatement();
              String sql ="Select * from client";
              resultSet = statement.executeQuery(sql);
              if (resultSet.next()){
            %>
      <ul class="navbar-nav ml-auto ml-md-0 d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle fa-fw"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
              <center><b style="background-color: white;"><%= session.getAttribute( "Name" ) %></b><center> 
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
          </div>
        </li>
      </ul>
              <%
              }
              connection.close();
              } catch (Exception e) {
              e.printStackTrace();
              }
              %>

    </nav>

    <div id="wrapper">

      <!-- Sidebar -->
      <ul class="sidebar navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="home.jsp">
            <i class="fas"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas"></i>
            <span>Services</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="PostServices.jsp">Post Services</a>
            <a class="dropdown-item" href="ShowServices.jsp">Show Services</a>
          </div>
        </li> 
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas"></i>
            <span>Transaction Monitoring</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="UpcomingTransaction.jsp">Upcoming</a>
            <a class="dropdown-item" href="InProgressTransaction.jsp">In Progress</a>
            <a class="dropdown-item" href="TerminatedTransaction.jsp">Terminated</a>
          </div>
        </li> 
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas"></i>
            <span>Manage User</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="NewUser.jsp">New</a>
            <a class="dropdown-item" href="RegisteredUser.jsp">Registered</a>
          </div>
        </li>  
        <li class="nav-item active">
          <a class="nav-link" href="register.jsp">
            <i class="fas"></i>
            <span>Register Admin</span>
          </a>
        </li>
      </ul>

      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="home.jsp">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Register Admin</li>
          </ol>
        <div class="card card-register mx-auto mt-3">
        <div class="card-header">Register an Account</div>
        <div class="card-body">
          <form>
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <label for="firstName">First name</label>
                  <div class="form-label-group">
                    <input name ="f_name" type="text" id="firstName" class="form-control" placeholder="First name" required="required" autofocus="autofocus">
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="lastName">Last name</label>
                  <div class="form-label-group">
                    <input name ="l_name" type="text" id="lastName" class="form-control" placeholder="Last name" required="required">
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail">Username</label>
              <div class="form-label-group">
                <input name="username" type="text" id="inputUname" class="form-control" placeholder="Username" required="required">
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <label for="inputPassword">Password</label>
                  <div class="form-label-group">
                    <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required="required">
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="confirmPassword">Confirm password</label>
                  <div class="form-label-group">
                    <input name="cPassword" type="password" id="confirmPassword" class="form-control" placeholder="Confirm password" required="required">
                  </div>
                </div>
              </div>
            </div>
            <input type="submit" name="btn_register" value="Register">
          </form>
        </div>
      </div>         
                  
        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright © Matatapang na Tao 2018</span>
            </div>
          </div>
        </footer>

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="logout.jsp">Logout</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>

  </body>

</html>
<%
    }
%>