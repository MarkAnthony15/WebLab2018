/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.RequestDispatcher;
import java.sql.*;

/**
 *
 * @author d524lab
 */
@WebServlet(urlPatterns = {"/RegistrationAction"})
public class RegistrationAction extends HttpServlet {
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        response.setContentType("text/html");
        PrintWriter pwOut;
        pwOut = response.getWriter();
        String first_name = request.getParameter("first_Name");
        String last_name = request.getParameter("last_Name");
        String email = request.getParameter("email");
        String pass = request.getParameter("password");
        String conPass = request.getParameter("conPass");
        
        if(first_name.isEmpty() || last_name.isEmpty() || email.isEmpty() || pass.isEmpty()){
            RequestDispatcher rd = request.getRequestDispatcher("register.jsp");
            pwOut.println("<font color=pink> Please fill all the fields or Both password do not match. </font>");
            rd.include(request, response);   
        }else {
            try{
                Class.forName("com.mysql.jdbc.Driver");
                
                try (Connection conn = DriverManager.getConnection("jdbc:mysql://localhost:3306/vendor", "root", null)) {
                    String query = "insert into spaccounts values(?,?,?,?)";
                    
                    PreparedStatement ps;
                    ps = conn.prepareStatement(query);
                    
                    ps.setString(1,first_name);
                    ps.setString(2,last_name);
                    ps.setString(3,pass);
                    ps.setString(4,email);
                    
                    ps.executeUpdate();
                    ps.close();
                    conn.close();
                }
            }catch (ClassNotFoundException | SQLException e){
            }
            RequestDispatcher rd = request.getRequestDispatcher("home.jsp");
            rd.forward(request,response);
        }
    }
}
