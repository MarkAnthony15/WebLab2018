/**
 * @date December 2, 2018
 * @author Julius
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


public class register extends HttpServlet {
    
    private static final long serialVersionUID = 1L;
       
    
     protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
	
		String first_name = request.getParameter("first_name");
		String last_name = request.getParameter("last_name");
		String email = request.getParameter("email");
		String password = request.getParameter("password");
		String confirm_password = request.getParameter("confirm_password");
		
		//This line block will redirect the user to the same registration page if and only if some fields are empty
                // or if the password and confirm password field does not match.
		if(first_name.isEmpty() || last_name.isEmpty() || email.isEmpty() || 
				password.isEmpty() || confirm_password.isEmpty() || password == confirm_password )
		{
			RequestDispatcher req = request.getRequestDispatcher("register.jsp");
			req.include(request, response); 
		}
                
                // redirection to log in page. This should mean that the account registered is already pending to be approved.
		else
		{
			RequestDispatcher req = request.getRequestDispatcher("index.jsp");
			req.forward(request, response);
		}
	}
    
}
