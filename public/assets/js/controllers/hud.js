var hud = new Vue({
    el: '#hud',
    data: {
        platforms: 0,
        servers: [],
        sharedServers: [],
        tasks: 0
    },
    ready: function () {
        this.getPlatforms();
        this.getServers();
        this.getSharedServers();
        this.getTasks();
        
    },
    computed: {},
    methods: {
        getPlatforms: function(){
            $.get( window.baseurl + "/api/platforms/true", function( results ) {
                hud.platforms = results.data.length;
            }).fail(function(e){
                console.log( "error "+ e );
            });
        },
        getServers: function(){
            $.get( window.baseurl + "/api/servers", function( results ) {
                hud.servers = results.data;
            }).fail(function(e){
                console.log( "error "+ e );
            });
        },
        getSharedServers: function(){
            $.get( window.baseurl + "/api/servers/shared", function( results ) {
                hud.sharedServers = results.data;
            }).fail(function(e){
                console.log( "error "+ e );
            });
        },
        getTasks: function(){
            $.get( window.baseurl + "/api/tasks", function( results ) {
                hud.tasks = results.data.length;
            }).fail(function(e){
                console.log( "error "+ e );
            });
        },
    }
});

