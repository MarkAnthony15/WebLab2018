<%-- 
    Document   : enableRegClient
    Created on : 11 29, 18, 7:59:44 PM
    Author     : Gigabyte
--%>

<%@page import="java.sql.*"%>
<%
  String id = request.getParameter("d");
  int no = Integer.parseInt(id);
  Class.forName("com.mysql.jdbc.Driver").newInstance();
  Connection conn = DriverManager.getConnection("jdbc:mysql://localhost:3306/weblove_atttirerentals","root","");
  Statement stmt = conn.createStatement();
  stmt.executeUpdate("UPDATE client SET status='Approved' where client_id='"+no+"'");
  response.sendRedirect("adminDisabledAccounts.jsp");
%>
