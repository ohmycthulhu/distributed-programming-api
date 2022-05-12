## Users resource
Path | Method | Payload | Description
--|--|--|--
/users | GET | - | To get list of users (only administors)
/users | POST | {name, email, password} | To create users (only administors)
/users/:id | GET | - | To get information about user (only administors)
/users/:id | DELETE | - | To delete users (only administors)
/users/:id | PUT | {name, email, password} | To update user info (only administors)


## User part
Path | Method | Payload | Description
--|--|--|--
/user | POST | {email, password} | To login
/user | GET | - | To get information about user
/user/projects | GET | - | To get projects of the user
For authentication, we may use JWT tokens.


## Projects resource
Path | Method | Payload | Description
--|--|--|--
/projects | GET | {keyword?, userId?} | To search projects
/projects | POST | {name, description, isPrivate} | To create project
/projects/:id | GET | - | To get information about project
/projects/:id | DELETE | - | To delete a project
/projects/:id | PUT | {name, description, isPrivate} | To update project


## Tags resource
Path | Method | Payload | Description
--|--|--|--
/projects/:id/tags | GET | - | To get project's tags
/projects/:id/tags | POST | {name} | To add tag to the project
/projects/:id/tags/:name | DELETE | - | To remove tag from the project
