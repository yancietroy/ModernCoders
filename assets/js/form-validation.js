$(document).ready(function() {
  $("form[name='form']").validate({
          rules: {
                first_name: "required",
                last_name: "required",
                birthdate: "required",
                age: "required",
                gender: "required",
                studentid: "required",
                school_year: "required",
                section: "required",
                college: "required",
                course: "required",
                org: "required",
                email: "required",
                password: "required",
                confirmpassword: "required": {
                  required: true,
              },
              /*
              txtConfirmPassword: {
                                required: true,
                                minlength: 8,
                                equalTo: "#txtNewPassword"
                            },
                            email: {
                                required: true,
                                email: true
                            }
                          }
*/

          messages: {
             first_name: "Please provide a valid name.",
              name: "Please provide a valid name.",
               name: "Please provide a valid name.",
                name: "Please provide a valid name.",
                 name: "Please provide a valid name.",
                  name: "Please provide a valid name.",
                   name: "Please provide a valid name.",
                    name: "Please provide a valid name.",
                     name: "Please provide a valid name.",
                      name: "Please provide a valid name.",
                       name: "Please provide a valid name.",
                        name: "Please provide a valid name.",
                         name: "Please provide a valid name.",
                          name: "Please provide a valid name.",
                           name: "Please provide a valid name.",
              password: {
                  required: "Please provide a password",
                  minlength: "Your password must be at least 8 characters long"
              },
              confirmpassword: {
                  required: "Please provide a password",
                  minlength: "Your password must be at least 8 characters long",
                  equalTo: "Please match the password entered"
              },
              submitHandler: function (form) {
                 form.submit();
          }
      });
          });
