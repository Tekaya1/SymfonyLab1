## 🚦 StudentController Routes & Results

| Route Pattern                | Methods        | Example URL                | Result / Response                                      | Emoji |
|------------------------------|---------------|----------------------------|--------------------------------------------------------|-------|
| `/students`                  | GET           | `/students`                | Hello from StudentController!                          | 👋    |
| `/students/{id<\d{2}>}`      | GET           | `/students/12`             | Details of student with ID: 12                         | 🆔    |
| `/students/{name}`           | GET, POST     | `/students/Alice`          | Renders `student/student.html.twig` with `name=Alice`  | 📝    |

- **👋**: List all students  
- **🆔**: Show details for a student by 2-digit ID  
- **📝**: Show or edit a student by name  