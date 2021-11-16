var platform = new Vue({
  el: '#platform',
  data: {
    platforms: [],
    platform: null,
    currentPlatform: null,
    newServerPlatformId: {name: null, server_id: null},
    newServer: {name: null, server_id: null},
    tempPlatformIndex: null,
    lastRequest: false,
    msg: {success: null, error: null}
  },

  ready: function(){
  	this.getPlatforms();
  },

  methods: {
  	getPlatforms: function(){
        $.get( window.baseurl + "/api/platforms/true", function( results ) {
            platform.platforms = results.data;
            Vue.nextTick(function () {
                megaMenuInit();
            })
        }).fail(function(e){
            console.log( e );
        });
  	},
    showCreateForm: function(){
          this.msg.success = null;
          this.msg.error = null;
          $(".new-platform").show();
          $(".new-platform .first").focus();
      },
  	create: function(new_platform, update){

		update = update || false;

		$.ajax({
		  type: 'POST',
		  url: window.baseurl + "/api/platforms",
		  data: new_platform,
		  error: function(e) {
		    var response = jQuery.parseJSON(e.responseText);
		  	$('.new-platform .status-msg').text("")
		  								.removeClass('success-msg')
		  								.addClass("error-msg")
		  								.text(response.message);			    
		  	return false;
		  },

		  success: function(result){			  		  	
		  	$('.new-platform .status-msg').text("")
		  								.removeClass('remove-msg')		  								
		  								.addClass("success-msg")
		  								.text(result.message);
						
			if (update == true){
                result.data.servers = [];
		  		platform.platforms.push(result.data);
				Vue.nextTick(function () {
					megaMenuInit();
				})		  		
		  	}

		  	new_platform.name = null;
		  	new_platform.description = null;
		  
            $('.popup-form.new-platform').find('input[type=text],textarea,select').filter(':visible:first').focus();
          }
		}); 
  	},
	startPlatformEditMode: function(platformIndex){
        this.msg.success = null;
        this.msg.error = null;
        this.currentPlatform = this.platforms[platformIndex];
        this.currentPlatform.position = platformIndex;

        $(".popup-form.update-platform").show();
        $(".popup-form.update-platform").find('input[type=text],textarea,select').filter(':visible:first').focus();
    },
    updatePlatform: function(){

        var data = this.currentPlatform;
        var id = data.id;
        data._method = "put";

        $.ajax({
            type: "POST",
            url: window.baseurl + "/api/platforms/"+id,
            data: data,
            success: function(e){
                console.log(e);
                platform.msg.success = e.message;
                platform.msg.error = null;
            },
            error: function(e){
                var response = jQuery.parseJSON(e.responseText);
                platform.msg.success = null;
                platform.msg.error = response.message;
            }
        });
    },
    deletePlatform: function(currentPlatform, platformIndex){
        this.currentPlatform = currentPlatform;

        showSheet();
        makePrompt(
            "Are you sure you want to delete the platform: "+currentPlatform.name+"?",
            "By deleting this platform you will loose all data associated with any server under this platform",
            "Not now", "Yes");

        $("#cancel-btn").click(function(){
            closePrompt();
        });

        $("#confirm-btn").click(function(){
            $.ajax({
                type: "POST",
                url: window.baseurl + "/api/platforms/"+currentPlatform.id,
                data: {_method: "delete"},
                success: function(){
                    platform.platforms.splice(platformIndex);
                    platform.currentPlatform = null;

                    $(".mega-menu .links a").removeClass("active").addClass("inactive");
                    $(".mega-menu .links a:first-child").removeClass("inactive").addClass("active");
                    $(".mega-menu .content .item").hide();
                    var id = "#" + $(".mega-menu .content div:first-child").show();

                    closePrompt();
                },
                error: function(){
                    platform.currentPlatform = null;
                    closePrompt();
                }
            });
        });
    },
    showNewServerForm: function(platformId, platformIndex){

        this.msg.success = null;
        this.msg.error = null;
        this.newServer.platform_id = platformId;
        this.tempPlatformIndex = platformIndex;

        $(".popup-form.new-server").show();
        $(".popup-form.new-server .first").focus();
    },
  	createServer: function(){

		 $.ajax({
		   type: 'POST',
		   url: window.baseurl + "/api/servers",
		   data: platform.newServer,
		   error: function(e) {
               var response = jQuery.parseJSON(e.responseText);
               platform.msg.success = null;
               platform.msg.error = response.message;
		   },
		    success: function(result){
                console.log(platform.platforms);
                console.log(result);
                platform.platforms[platform.tempPlatformIndex].servers.push(result.data);
                platform.msg.success = result.message;
                platform.msg.error = null;

                platform.newServer.name = null;
                platform.newServer.server_id = null;
                $('.popup-form.new-server').find('input[type=text],textarea,select').filter(':visible:first').focus();
            }
		 });
  	}
  }

});