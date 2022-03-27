window.onload = function(){
    function fetchAjax(url,method,funcSucc,funcErr,dataUI){
        try{
            $.ajax({
                url : url,
                method : method,
                dataType : "json",
                data : dataUI,
                success : function(data){
                    //  console.log(data)
                     funcSucc(data);
                },
                error : function(xhr){
                    funcErr(xhr)
                }
           });
        }catch(e){
           console.log(e);
        }
   }
 
   var location = window.location.pathname;
    //console.log(location);
   //registracija
    var reEmail =  /^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/;
    var rePassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
    var reFristName = /^([A-Z][a-z]{2,15})+$/;
    var reLastName = /^([A-Z][a-z]{2,20})+$/;

   if(location == '/phpSajt/register.php'){
     btnReg.addEventListener('click',function(){
         let fname =  document.querySelector('#fname');
         let lname =  document.querySelector('#lname');
         let emailRegister = document.querySelector('#emailRegister');
         let password = document.querySelector('#password');
         let passwordRe = document.querySelector('#passwordRe');
         var err = 0;

         validRegex(fname,reFristName);
         validRegex(lname,reLastName);
         validRegex(emailRegister,reEmail);
         validRegex(password,rePassword);

         if(password.value !== passwordRe.value){
            passwordRe.nextElementSibling.classList.remove('hide');
            passwordRe.classList.add('err')
            err++;
         }else{
             if(passwordRe.value.length > 1){
                passwordRe.classList.remove('err');
                passwordRe.classList.add('succ');
                passwordRe.nextElementSibling.classList.add('hide');
             }
         }
    
         function validRegex(obj,reg){
            if(!reg.test(obj.value)){
                obj.classList.add('err');
                obj.nextElementSibling.classList.remove('hide');
                err++;
             }else{
                obj.classList.remove('err');
                obj.classList.add('succ');
                obj.nextElementSibling.classList.add('hide');
             }
           }
           if(err==0){
               let dataUI = {
                   fnameUI : fname.value,
                   lnameUI : lname.value,
                   emailUI : emailRegister.value,
                   passwordUI : password.value,
                   passwordReUI : passwordRe.value
               }
              fetchAjax("models/processRegistration.php","POST",regSucc,regErr,dataUI);
           }
     })
   }
   function regSucc(data){
    msg.innerHTML = `<p class="alert alert-success mt-5">${data.msg}</p>`;
    setTimeout(function(){
    window.location.href = 'login.php';
    }, 2000);
    }
    function regErr(xhr){
        msg.innerHTML = `<p class="alert alert-danger mt-5">${JSON.parse(xhr.responseText).msg}</p>`;
        clearInput(fname);
        clearInput(lname);
        clearInput(emailRegister);
        clearInput(password);
        passwordRe.value = '';
    }
    function clearInput(obj){
        obj.value = '';
        obj.classList.remove('succ');
    }

   if(location == '/phpSajt/contact.php'){
    btnMsg.addEventListener('click',function(){
        let subject =  document.querySelector('#subject');
        let emailMsg = document.querySelector('#emailMsg');
        let message = document.querySelector('#message');
        var err = 0;
        let subjectRe = /^([A-Z]|[0-9])[\sA-Za-z\d.?,!_-]{2,19}$/;
        validRegex(subject,subjectRe);
        validRegex(emailMsg,reEmail);
        
        function validRegex(obj,reg){
           if(!reg.test(obj.value)){
               obj.classList.add('err');
               obj.nextElementSibling.classList.remove('hide');
               err++;
            }else{
               obj.classList.remove('err');
               obj.classList.add('succ');
               obj.nextElementSibling.classList.add('hide');
            }
          }
          if(message.value < 20){
            message.classList.add('err');
            message.classList.remove('succ');
            message.nextElementSibling.classList.remove('hide');
                err++;
        }else{
            message.classList.remove('err');
            message.classList.add('succ');
            message.nextElementSibling.classList.add('hide')
        }
          if(err==0){
              let dataUI = {
                subjectUI : subject.value,
                emailMsgUI : emailMsg.value,
                messageUI : message.value,
                  
              }
             fetchAjax("models/proccessMessages.php","POST",msgSucc,msgErr,dataUI);
          }
    })
  }
   function msgSucc(data){
        msg.innerHTML = `<p class="alert alert-success mt-5">${data.msg}</p>`;
        setTimeout(function(){
        window.location.reload();
        }, 2000);
   }
   function msgErr(xhr){
        msg.innerHTML = `<p class="alert alert-danger mt-5">${JSON.parse(xhr.responseText).msg}</p>`;
        setTimeout(function(){
            msg.innerHTML = '';
        }, 2000);
   }
    
   if(location == "/phpSajt/login.php"){
    //event za logovanje
    btnLog.addEventListener('click',function(){
        let email = document.querySelector('#email');
        let passwordLog = document.querySelector('#passwordLog');
        let err = 0;
        
        if(!reEmail.test(email.value)){
            email.classList.add('err');
            email.nextElementSibling.classList.remove('hide');
                err++;
        }else{
            email.classList.remove('err');
            email.classList.add('succ');
            email.nextElementSibling.classList.add('hide');
         }
         if(!rePassword.test(passwordLog.value)){
            passwordLog.classList.add('err');
            passwordLog.nextElementSibling.classList.remove('hide');
                err++;
        }else{
            passwordLog.classList.remove('err');
            passwordLog.classList.add('succ');
            passwordLog.nextElementSibling.classList.add('hide');
         }
         if(err == 0){
            let dataUI = {
                emailUI : email.value,
                passwordUI : passwordLog.value,
            }
            fetchAjax("models/processLogin.php","POST",logSucc,logErr,dataUI)
         }
    })
    function logSucc(data){
        msg.innerHTML = `<p class="alert alert-success mt-5">${data.msg}</p>`;
        setTimeout(function(){
        window.location.href = 'profile.php';
        }, 1000);
    }
    function logErr(xhr){
        msg.innerHTML = `<p class="alert alert-danger mt-5">${JSON.parse(xhr.responseText).msg}</p>`;
        setTimeout(function(){
            msg.innerHTML = '';
        },1000);
        clearInput(email);
        clearInput(passwordLog);
    }
   }
    //event za dugme za komentare   
   if(location == "/phpSajt/blog-details.php"){
    //    alert("tu");
    btnComm.addEventListener('click',function(){
        let comment = document.querySelector("#taComment");
        if(comment.value.length < 2){
            comment.classList.add('err');
            comment.classList.remove('succ');
            comment.nextElementSibling.nextElementSibling.classList.remove('hide');
        }
        else{
            comment.classList.remove('err');
            comment.classList.add('succ');
            comment.nextElementSibling.nextElementSibling.classList.add('hide')
            let dataUI = {
                commentUI : comment.value,
                postIdUI : comment.dataset.idpost
            };
            fetchAjax("models/processComment.php","POST",commSucc,commErr,dataUI);
        }
    });
    function commSucc(data){
        msg.innerHTML = `<p class="alert alert-success mt-5">${data.msg}</p>`;
        setTimeout(function(){
            window.location.reload();
        },1000);
    }
    function commErr(xhr){
        msg.innerHTML = `<p class="alert alert-danger mt-5">${JSON.parse(xhr.responseText).msg}</p>`;
    }
   }
   if(location == "/phpSajt/profile.php" || location == "/phpSajt/admin.php"){
    $(document).on("click",".deletePost",function(e){
       e.preventDefault();
       let id = this.dataset.idpost;
       dataUI = {
            idPost : id
        };
    fetchAjax("models/deletePost.php","POST",proba1,proba2,dataUI);
    });
   }
   function proba1(data){
    msg.innerHTML = `<p class="alert alert-success mt-5">${data.msg}</p>`;
    setTimeout(function(){
        window.location.reload();
    },1000);
    }
    function proba2(xhr){
        msg.innerHTML = `<p class="alert alert-danger mt-5">${JSON.parse(xhr.responseText).msg}</p>`;
        setTimeout(function(){
            msg.innerHTML = '';
        },2000);
    }
    if(location == "/phpSajt/admin.php"){
        $("#allUsers").on("click",function(){
            $.ajax({
                url : 'models/adminGetUsers.php',
                dataType : 'json',
                type : 'GET',
                success : function(result){
                adminContent.innerHTML = result;
                },
                error: function(xhr){
                    adminContent.innerHTML = `<p class="lead">${JSON.parse(xhr.responseText).msg}</p>`;
                }
            })   
        });
        $(document).on("click",".link-limit-user",function(){
            let limitNum = this.dataset.idusers;
            $.ajax({
                url : 'models/adminGetUsers.php',
                dataType : 'json',
                method : 'GET',
                data : {
                    limit :limitNum
                },
                success : function(result){
                adminContent.innerHTML = result;
                },
                error: function(xhr){
                    adminContent.innerHTML = `<p class="lead">${JSON.parse(xhr.responseText).msg}</p>`;
                }
            })   
        });
        $(document).on("click",".deleteUser",function(e){
           e.preventDefault();
           let id = this.dataset.iduser;
           dataUI = {
                idUser : id
            };
        fetchAjax("models/deleteUser.php","POST",proba1,proba2,dataUI);
        });
        $("#allPosts").on("click",function(){
            $.ajax({
                url : 'models/adminGetPosts.php',
                dataType : 'json',
                type : 'GET',
                success : function(result){
                adminContent.innerHTML = result;
                },
                error: function(xhr){
                    adminContent.innerHTML = `<p class="lead">${JSON.parse(xhr.responseText).msg}</p>`;
                }
            })   
        });
        $(document).on("click",".link-limit-post",function(){
            let limitNum = this.dataset.idpos;
            $.ajax({
                url : 'models/adminGetPosts.php',
                dataType : 'json',
                method : 'GET',
                data : {
                    limit :limitNum
                },
                success : function(result){
                adminContent.innerHTML = result;
                },
                error: function(xhr){
                    adminContent.innerHTML = `<p class="lead">${JSON.parse(xhr.responseText).msg}</p>`;
                }
            })   
        });
        $(document).on("click",".deleteCat",function(e){
            e.preventDefault();
            let id = this.dataset.idcat;
            dataUI = {
                 idCat : id
             };
          fetchAjax("models/deleteCategory.php","POST",proba1,proba2,dataUI);
         });
    }
    $("#allCats").on("click",function(){
        $.ajax({
            url : 'models/adminGetCats.php',
            dataType : 'json',
            type : 'GET',
            success : function(result){
            adminContent.innerHTML = result;
            },
            error: function(xhr){
                adminContent.innerHTML = `<p class="lead">${JSON.parse(xhr.responseText).msg}</p>`;
            }
        })   
    });
    $(document).on("click",".link-limit-cats",function(){
        let limitNum = this.dataset.idcats;
        $.ajax({
            url : 'models/adminGetCats.php',
            dataType : 'json',
            method : 'GET',
            data : {
                limit :limitNum
            },
            success : function(result){
            adminContent.innerHTML = result;
            },
            error: function(xhr){
                adminContent.innerHTML = `<p class="lead">${JSON.parse(xhr.responseText).msg}</p>`;
            }
        })   
    });
    $(document).on("click","#addCat",function(){
       let newCat = document.querySelector("#addCategories");
       let catRe = /^([A-Z]|[0-9])[\sA-Za-z\d.?,!_-]{2,48}$/;
       if(!catRe.test(newCat.value)){
        newCat.classList.add('err');
        newCat.classList.remove('succ');
    }else{
        newCat.classList.remove('err');
        newCat.classList.add('succ');
        let dataUI = {
            nameCatUI : newCat.value
        }
         fetchAjax("models/addCategory.php","POST",proba1,proba2,dataUI);
    }
    })
    $("#survey").on("click",function(){
        $.ajax({
            url : 'models/adminGetSurveys.php',
            dataType : 'json',
            type : 'GET',
            success : function(result){
            adminContent.innerHTML = result;
            },
            error: function(xhr){
                adminContent.innerHTML = `<p class="lead">${JSON.parse(xhr.responseText).msg}</p>`;
            }
        })   
    });
    $(document).on("click",".link-limit-survey",function(){
        let limitNum = this.dataset.idsurv;
        $.ajax({
            url : 'models/adminGetSurveys.php',
            dataType : 'json',
            method : 'GET',
            data : {
                limit :limitNum
            },
            success : function(result){
            adminContent.innerHTML = result;
            },
            error: function(xhr){
                adminContent.innerHTML = `<p class="lead">${JSON.parse(xhr.responseText).msg}</p>`;
            }
        })   
    });
    $(document).on("click","#addSurv",function(){
        let output = `<form method="post" action="models/insertSurvey.php"
            onsubmit=" return checkSurvey();">
            <div id="surveyForm">
            <label for="question">Survey question:</label>
            <input type="text" name="question" id="question"
            class="form-control">
            <label for="answer">Survey answer 1:</label>
            <input type="text" name="answer[]" id="answer1"
            class="form-control answer">
            </div>
            <button type="button" name="addAnswer"
            id="addAnswer" class="btn btn-primary mt-3">Add a new answer</button>
            <button type="submit" name="addSurvey"
            value="addSurvey" class="btn btn-primary mt-3">Add</button>
            </form>`;
            adminContent.innerHTML = output;
            var numAnswers = 1;
            $(document).on('click', '#addAnswer',function(){
            let odgovor = `<label>Survey answer ${++numAnswers}:</label>
            <input type="text" name="answer[]" class="form-control odg
            odg${numAnswers}">`;
            $("#surveyForm").append($(odgovor));
            })
    })
    $(document).on("click",".deleteSurv",function(e){
        e.preventDefault();
        let id = this.dataset.idsurv;
        dataUI = {
             idSurv : id
         };
      fetchAjax("models/deleteSurvey.php","POST",proba1,proba2,dataUI);
     });
     $(document).on("click","#btnSend",function(){
        let rb = document.getElementsByName("rb");
        let hidden = document.querySelector("#hiddenSurvey").value;
        let id = '';
        for(i in rb){
           if(rb[i].checked){
                id = rb[i].value;
           }
       }
       if(id){
           let dataUI = {
               idSurvey : hidden,
               idAnswear : id
           }
        fetchAjax("models/processSurvey.php","POST",proba1,proba2,dataUI);
       
       }
     })
}
function checkSurvey(){
    let question = document.querySelector("#question");
    let answer = document.querySelectorAll(".answer");
    let questionRe = /^([A-Z]|[0-9])[\sA-Za-z\d.?,!_-]{2,48}$/;
    let err = 0;
    for(a of answer){
        if(!questionRe.test(a.value)){
            a.classList.add('err');
            a.classList.remove('succ');
            err++;
        }else{
            a.classList.remove('err');
            a.classList.add('succ');
        }
    }
    if(!questionRe.test(question.value)){
        question.classList.add('err');
        question.classList.remove('succ');
        err++;
    }else{
        question.classList.remove('err');
        question.classList.add('succ');
    }
    if(err==0){
        return true;
    }else{
        return false;
    }
}
let loc = window.location.pathname;
if(loc=="/phpSajt/newpost.php"){
    function checkPost(){
        let title = document.querySelector("#postTitle");
        let category = document.querySelector("#ddl");
        let descPost = document.querySelector("#tekstPost");
        let file = document.querySelector("#file");
    
        let titleRe = /^([A-Z]|[0-9])[\sA-Za-z\d.?,!_-]{2,78}$/;
        let err = 0;
        if(!titleRe.test(title.value)){
            title.classList.add('err');
            title.classList.remove('succ');
            title.nextElementSibling.classList.remove('hide');
                err++;
        }else{
            title.classList.remove('err');
            title.classList.add('succ');
            title.nextElementSibling.classList.add('hide')
        }
    
        if(category.options.selectedIndex =="0"){
            category.classList.add('err');
            category.classList.remove('succ');
            category.nextElementSibling.classList.remove('hide');
                err++;
        }else{
            category.classList.remove('err');
            category.classList.add('succ');
            category.nextElementSibling.classList.add('hide')
        }
        if(descPost.value.length < 100){
            descPost.classList.add('err');
            descPost.classList.remove('succ');
            descPost.nextElementSibling.classList.remove('hide');
                err++;
        }else{
            descPost.classList.remove('err');
            descPost.classList.add('succ');
            descPost.nextElementSibling.classList.add('hide')
        }
        if(file.value==""){
            file.classList.add('err');
            file.classList.remove('succ');
            file.nextElementSibling.classList.remove('hide');
                err++;
        }else{
            file.classList.remove('err');
            file.classList.add('succ');
            file.nextElementSibling.classList.add('hide')
        }
        if(err==0){
           return true;
        }else{
            return false;
        }
    }
}
if(loc=="/phpSajt/edit-post.php"){
    function checkEditedPost(){
        let editTitle = document.querySelector("#editTitle");
        let ddlEdit = document.querySelector("#ddlEdit");
        let editText = document.querySelector("#editText");
        let editFile = document.querySelector("#editFile");
    
        let titleRe = /^([A-Z]|[0-9])[\sA-Za-z\d.?,!_-]{2,78}$/;
        let err = 0;
        if(!titleRe.test(editTitle.value)){
            editTitle.classList.add('err');
            editTitle.classList.remove('succ');
            editTitle.nextElementSibling.classList.remove('hide');
                err++;
        }else{
            editTitle.classList.remove('err');
            editTitle.classList.add('succ');
            editTitle.nextElementSibling.classList.add('hide')
        }
    
        if(ddlEdit.options.selectedIndex =="0"){
            ddlEdit.classList.add('err');
            ddlEdit.classList.remove('succ');
            ddlEdit.nextElementSibling.classList.remove('hide');
                err++;
        }else{
            ddlEdit.classList.remove('err');
            ddlEdit.classList.add('succ');
            ddlEdit.nextElementSibling.classList.add('hide')
        }
        if(editText.value < 100){
            editText.classList.add('err');
            editText.classList.remove('succ');
            editText.nextElementSibling.classList.remove('hide');
                err++;
        }else{
            editText.classList.remove('err');
            editText.classList.add('succ');
            editText.nextElementSibling.classList.add('hide')
        }
        if(editFile.value==""){
            editFile.classList.add('err');
            editFile.classList.remove('succ');
            editFile.nextElementSibling.classList.remove('hide');
                err++;
        }else{
            editFile.classList.remove('err');
            editFile.classList.add('succ');
            editFile.nextElementSibling.classList.add('hide')
        }
        if(err==0){
           return true;
        }else{
            return false;
        }
    }
    
}
