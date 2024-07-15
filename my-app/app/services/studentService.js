angular.module("studentApp").service("StudentService", function ($http) {
  this.getStudents = function () {
    return $http.get("/api/students");
  };

  this.addStudent = function (student) {
    return $http.post("/api/students", student);
  };

  this.deleteStudent = function (id) {
    return $http.delete("/api/students/" + id);
  };
});
