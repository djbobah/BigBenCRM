angular
  .module("studentApp")
  .controller("StudentController", function (StudentService) {
    var vm = this;
    vm.students = [];
    vm.newStudent = {};

    vm.getStudents = function () {
      StudentService.getStudents().then(function (response) {
        vm.students = response.data;
      });
    };

    vm.addStudent = function () {
      StudentService.addStudent(vm.newStudent).then(function (response) {
        vm.students.push(response.data);
        vm.newStudent = {};
      });
    };

    vm.editStudent = function (student) {
      // Логика редактирования
    };

    vm.deleteStudent = function (id) {
      StudentService.deleteStudent(id).then(function () {
        vm.getStudents();
      });
    };

    vm.getStudents();
  });
