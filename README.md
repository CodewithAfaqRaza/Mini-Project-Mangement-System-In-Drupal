
Project Management System
Overview
The Project Management System is a comprehensive web application that allows you to efficiently manage projects, users, and tasks. The system includes a robust user authentication system with role-based access, making it ideal for managing different types of users and their permissions. With this system, you can assign users to projects, manage tasks within those projects, and provide personalized dashboards based on the user’s role.

Key Features:
User Management:

Create, update, and delete user profiles.
Role-based access control (Admin, Manager, Developer, etc.).
Project Management:

Create, update, and assign projects to users.
Track project progress and deadlines.
Task Management:

Create, assign, and track tasks within projects.
Define task priorities, deadlines, and statuses.
Role-Based Authentication:

Fully secure authentication system with role-based authorization.
Different dashboards and access controls based on user roles (Admin, Manager, Developer, etc.).
Dashboards Based on Roles:

Admin Dashboard: Admin can manage users, projects, and tasks.
Manager Dashboard: Managers can assign tasks to team members, track project progress, and view analytics.
Developer Dashboard: Developers can view their assigned tasks, update progress, and collaborate with team members.







User Authentication and Roles
Authentication
The system features a fully integrated authentication system based on JWT (JSON Web Tokens). Users can sign up, log in, and manage their accounts securely. Upon login, users are assigned roles, which determine their access levels and dashboards.

Roles
Admin:

Full access to all system features, including managing users, projects, and tasks.
Can view all project and task data across the system.
Manager:

Can manage projects, assign tasks to users, and view project progress.
Can track the progress of tasks and assign deadlines.
Developer:

Can only view tasks assigned to them, update task progress, and communicate with managers.
Limited access to the system and cannot manage projects or other users.
Each user role is protected by role-based authentication to ensure they only have access to features and data relevant to their role.

Project Management
Creating and Managing Projects
Create Project: Admins and Managers can create new projects by providing the project name, description, start date, and deadline.
Assign Projects: Projects can be assigned to users (Managers and Developers).
View Projects: Users can view the projects they are assigned to and track their progress.
Task Management
Create Task: Admins and Managers can create tasks, assign them to users, and set priorities and deadlines.
Assign Task: Tasks can be assigned to specific users (typically Developers).
Track Task Progress: Developers can update task status and log their progress.
Task Notifications: Users are notified of new tasks and changes to existing tasks.
Dashboards
The dashboard UI is dynamically generated based on the user's role:

Admin Dashboard:

View and manage all users, projects, and tasks.
Overview of system activity and performance.
Access to all project and task data.
Manager Dashboard:

View assigned projects and tasks.
Assign and track tasks.
View team members’ progress and productivity metrics.
Developer Dashboard:

View personal tasks and updates.
Track task progress and mark tasks as complete.
Communicate with managers regarding tasks.
Contributing
We welcome contributions to the Project Management System! Please follow these steps to contribute:

Fork the repository.
Create a new branch for your feature or bugfix.
Make your changes.
Run tests to ensure everything is working.
Create a pull request with a description of your changes.
Reporting Issues
If you encounter any issues, please report them via the Issues section of the repository.

License
This project is licensed under the MIT License - see the LICENSE file for details.
