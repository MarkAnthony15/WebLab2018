/**
 * @date December 2, 2018
 * @author Admin
 */
package com.user.sp;

import java.io.IOException;
import java.io.PrintWriter;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import javax.servlet.RequestDispatcher;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

/**
 *
 * @author Admin
 */
@WebServlet(name = "validate", urlPatterns = {"/validate1"})
public class validate extends HttpServlet {

    protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        
    String username = request.getParameter("email");   
    String password = request.getParameter("password");
        
           if ((username == null) || (password == null) ){
        response.sendRedirect("index.jsp");
    }else {
        try{
           
            String firstname="";
            Class.forName("com.mysql.jdbc.Driver");  // MySQL database connection
            Connection conn = DriverManager.getConnection("jdbc:mysql://localhost:3306/weblove_atttirerentals?" + "user=root&password=");   
            PreparedStatement pst = conn.prepareStatement("Select * from administrator where username=? and password=? and (role = 'superadmin' or role='admin') and status= 'Approved'");
            pst.setString(1, username);
            pst.setString(2, password);
            ResultSet rs = pst.executeQuery();
            while(rs.next()){
                
                if(rs.getString("role").equals("superadmin")){
                   firstname = rs.getString("FirstName");
                   //session.setAttribute("Name",firstname);
                   response.sendRedirect("home.jsp");
                }else if(rs.getString("role").equals("admin")){
                   firstname = rs.getString("FirstName");
                   //session.setAttribute("Name",firstname);
                   response.sendRedirect("adminHome.jsp");
                }else{
                 //   session.invalidate();
                    request.setAttribute("errorMessage", "Invalid username or password");
                    RequestDispatcher rd = request.getRequestDispatcher("index.jsp");
                    rd.forward(request, response);
                    response.sendRedirect("index.jsp");           

                }                
            }
        }
       catch(Exception e){       
           System.out.println(e); 
           //e.printStackTrace();
       }
    }
}
}
