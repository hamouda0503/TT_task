
var server = new Vue({
    el: '#server',
    data: {
        server: { id: null, name : null, weight : null, cpu : null, os : null, os_ver: null, description: null, ram : null, stockage : null, nbr_partition: null},
        newServer: {name: null, server_id: null},
        newTask: {name: null, weight: null, state: null, priority: null, description: null , dueDate :new Date().toISOString().substr(0, 10)},
        currentTask: {name: null, weight: null, state: null, priority: null, description: null, dueDate : null},
        newCredential: {type: null, name: null, hostname: null, username: null, password: null, port: null},
        currentCredential: {type: null, name: null, hostname: null, username: null, password: null, port: null},
        msg: {success: null, error: null},
        owner: {id: null},
        members: [],
        invited: {email: null},
     

    },
  
    ready: function(){
        this.setupServer();
      
    },
    computed: {
        serverWeight: function(){
            var tasks = this.server.tasks;
            var remainingWeight = 0;

            for (var i = 0; i < tasks.length; i++){
                if( tasks[i].state != "complete" ){
                    remainingWeight = remainingWeight + Number(tasks[i].weight);
                }
            }
       
            return remainingWeight;
        },
        numTasks: function(){
            var tasks = this.server.tasks;
            var finalNum = 0;
      
           
            for (var i = 0; i < tasks.length; i++){
                if( tasks[i].state != "daily" ){
                    finalNum++;
                } 
                
            }
             
            return finalNum ;
        },
        numProgressTasks: function(){
            var tasks = this.server.tasks;
            var finalNum = 0;

            for (var i = 0; i < tasks.length; i++){
                if( tasks[i].state == "progress" ){
                    finalNum++;
                }
            }

            return finalNum;
        },
        numTestingTasks: function(){
            var tasks = this.server.tasks;
            var finalNum = 0;

            for (var i = 0; i < tasks.length; i++){
                if( tasks[i].state == "testing" ){
                    finalNum++;
                }
            }

            return finalNum;
        },
        numCompleteTasks: function(){
            var tasks = this.server.tasks;
            var finalNum = 0;

            for (var i = 0; i < tasks.length; i++){
                if( tasks[i].state == "complete" ){
                    finalNum++;
                }
            }

            return finalNum;
        },
        numDailyTasks: function(){
            var tasks = this.server.tasks;
            var finalNum = 0;

            for (var i = 0; i < tasks.length; i++){
                if( tasks[i].state == "daily" ){
                    finalNum++;
                }
            }

            return finalNum;
        },
        
        numCredentials: function(){
            return this.server.credentials.length;
        },
        serverProgress: function(){
            var tasks = this.server.tasks;
            var totalWeight = 0;
            var completedWeight = 0;

            for (var i = 0; i < tasks.length; i++){
                totalWeight = totalWeight + Number(tasks[i].weight);

                if( tasks[i].state == "complete" ){
                    completedWeight = completedWeight + Number(tasks[i].weight);
                }
            }
            return  (completedWeight / totalWeight) * 100;
        }
        
    },
    
    methods: {
        setupServer: function(){ 
            this.getOwner();
            this.getMembers();
            var url = window.location.href,
                server_id  = url.split('/').splice(-1);

            $.get( window.baseurl + "/api/servers/"+server_id, function( results ) {
                server.server = results.data;
                Vue.nextTick(function () {
                    megaMenuInit();
                })
            }).fail(function(e){
                console.log( "error "+ e );
            });
        },
        startServerEditMode: function(){
            this.msg.success = null;
            this.msg.error = null;
            $(".popup-form.update-server").show();
            $(".popup-form.update-server .first").focus();
        },
        updateServer: function(){

            var updatedServer = this.server;

            delete updatedServer.tasks;
            delete updatedServer.credentials;

            updatedServer._method = "put";

            $.ajax({
                type: 'POST',
                url: window.baseurl + "/api/servers/"+ updatedServer.id,
                data: updatedServer,
                error: function(e) {
                    var response = jQuery.parseJSON(e.responseText);

                    server.msg.success = null;
                    server.msg.error = response.message;

                    return false;
                },
                success: function(result){
                    server.msg.success = result.message;
                    server.msg.error = null;
                }
            });
        },
        deleteTask: function(taskId){
            showSheet();
            makePrompt("Are you sure you want to delete this task?","","No now", "Yes");

            $("#cancel-btn").click(function(){
                closePrompt();
            });

            $("#confirm-btn").click(function(){
                $.ajax({
                    type: "POST",
                    url: window.baseurl + "/api/tasks/"+taskId,
                    data: {_method: "delete"},
                    success: function(){
                        $(".task-"+taskId).hide();
                        closePrompt();
                    },
                    error: function(e){
                        closePrompt();
                    }
                });
            });
        },
        showTaskCreateForm: function(){
            this.msg.success = null;
            this.msg.error = null;
            $(".popup-form.new-task").show();
            $(".popup-form.new-task .first").focus();
        },
        createTask: function(platform_id, server_id){


            $.ajax({
                type: 'POST',
                url: window.baseurl + "/api/tasks/"+ platform_id +"/"+ server_id,
                data: server.newTask,
                error: function(e) {
                    var response = jQuery.parseJSON(e.responseText);

                    server.msg.success = null;
                    server.msg.error = response.message;

                    return false;
                },

                success: function(result){
                    server.msg.success = result.message;
                    server.msg.error = null;

                    server.server.tasks.push(result.data);
                    Vue.nextTick(function () {
                        megaMenuInit();
                    });

                    server.newTask.name = null;
                    server.newTask.description = null;

                    $('.popup-form.new-task select option:first-child').attr("selected", "selected");
                    $('.popup-form.new-task').find('input,textarea,select').filter(':visible:first').focus();
                }
            });
        },
        editMode: function(task){
            this.msg.success = null;
            this.msg.error = null;
            this.currentTask = task;
            $(".popup-form.update-task").show();
            $(".popup-form.update-task .first").focus();
        },
        updateTask: function(taskId){


            this.currentTask._method = "put";

            $.ajax({
                type: 'POST',
                url: window.baseurl + "/api/tasks/"+ taskId,
                data: server.currentTask,
                error: function(e) {
                    var response = jQuery.parseJSON(e.responseText);

                    server.msg.success = null;
                    server.msg.error = response.message;

                    return false;
                },
                success: function(result){
                    server.msg.success = result.message;
                    server.msg.error = null;
                }
            });
        },
        createCredential: function(user_id, server_id){


            var credential = this.newCredential;
            credential.user_id = user_id;
            credential.server_id = server_id;

            $.ajax({
                type: 'POST',
                url: window.baseurl + "/api/credentials",
                data: credential,
                error: function(e) {
                    var response = jQuery.parseJSON(e.responseText);

                    server.msg.success = null;
                    server.msg.error = response.message;

                    return false;
                },
                success: function(result){
                    server.msg.success = result.message;
                    server.msg.error = null;

                    server.server.credentials.push(result.data);

                    server.newCredential.name = null;
                    server.newCredential.username = null;
                    server.newCredential.hostname = null;
                    server.newCredential.password = null;
                    server.newCredential.port = null;
                }
            });
        },
        deleteCredential: function(credential){
            showSheet();
            makePrompt("Are you sure you want to delete this credential?","","No now", "Yes");

            $("#cancel-btn").click(function(){
                closePrompt();
            });

            $("#confirm-btn").click(function(){
                $.ajax({
                    type: "POST",
                    url: window.baseurl + "/api/credentials/"+credential.id,
                    data: {_method: "delete"},
                    success: function(){
                        server.server.credentials.$remove(credential);
                        closePrompt();
                    },
                    error: function(e){
                        closePrompt();
                    }
                });
            });
        },
        editCredential: function(credential){
            this.msg.success = null;
            this.msg.error = null;
            this.currentCredential = credential ;
            $(".popup-form.update-credential").show();
            $(".popup-form.update-credential .first").focus();
        },
        updateCredential: function(credentialId){

            this.currentCredential._method = "put";

            $.ajax({
                type: 'POST',
                url: window.baseurl + "/api/credentials/"+ credentialId,
                data: server.currentCredential,
                error: function(e) {
                    var response = jQuery.parseJSON(e.responseText);

                    server.msg.success = null;
                    server.msg.error = response.message;

                    return false;
                },
                success: function(result){
                    server.msg.success = result.message;
                    server.msg.error = null;
                }
            });
        },
        getOwner: function(){
            var url = window.location.href,
                server_id  = url.split('/').splice(-1);

            $.get( window.baseurl + "/api/servers/"+server_id+"/owner", function( results ) {
                server.owner = results.data;
                Vue.nextTick(function () {
                    megaMenuInit();
                })
            }).fail(function(e){
                console.log( "error "+ e );
            });
        },
        getMembers: function(){
            var url = window.location.href,
                server_id  = url.split('/').splice(-1);

            $.get( window.baseurl + "/api/servers/"+server_id+"/members", function( results ) {
                server.members = results.data;
                console.log(server.members);
                Vue.nextTick(function () {
                    megaMenuInit();
                })
            }).fail(function(e){
                console.log( "error "+ e );
            });
        },
        inviteUser: function(server_id){
            if(this.invited.email == ""){
                this.invited.email = "";
            }

            $.ajax({
                type: 'POST',
                url: window.baseurl + "/api/servers/"+ server_id +"/"+this.invited.email+"/invite",
                data: server.currentCredential,
                error: function(e) {
                    var response = jQuery.parseJSON(e.responseText);

                    server.msg.success = null;
                    server.msg.error = response.message;

                    return false;
                },
                success: function(result){
                    server.members.push(result.data);
                    server.msg.success = result.message;
                    server.msg.error = null;
                }
            });
        },
        removeMember: function(server_id, member){
            showSheet();
            makePrompt("Are you sure you want to remove this member from this server?","","Not now", "Yes");

            $("#cancel-btn").click(function(){
                closePrompt();
            });

            $("#confirm-btn").click(function(){
                $.ajax({
                    type: "POST",
                    url: window.baseurl + "/api/servers/"+server_id+"/"+member.id+"/remove",
                    data: {_method: "delete"},
                    success: function(){
                        server.members.$remove(member);
                        closePrompt();
                    },
                    error: function(e){
                        closePrompt();
                    }
                });
            });
        }
    }

});



