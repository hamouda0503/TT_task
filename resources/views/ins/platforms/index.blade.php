@extends('templates/ins/master')

@section('content')
    
<div id="platform" >
    <div class="row" >
        <div class="col-xs-12 page-title-section">
            <h1 class="pull-left"> <i class="fas fa-network-wired"></i>  Platforms</h1>
            <a v-on:click="showCreateForm()" class="btn btn-primary pull-right" title="Create new platform" style="color:#fff ;" >+ New Platform</a>
            <div class="clearfix"></div>
        </div>
    </div>

    <template v-if="platforms.length != 0" >
        <div class="row" >
            <div class="col-xs-12" >
                <div class="mega-menu" >
                    <div class="links" style="background-color:#fafafa ">
                        <a v-for="platform in platforms" data-id="platform_@{{platform.id}}" href="">
                            Name : @{{platform.name}}
                        </a>
                    </div>
 
                    <div class="content" style="background-color:#fafafa ">
                        <div v-for="platform in platforms" class="item" id="platform_@{{platform.id}}" title="Edit platform">
                            <header>
                                <div class="platform platform-info-@{{$index}} page-title-section">
                                    <h2 class="pull-left">@{{platform.name}} <a v-on:click="startPlatformEditMode($index)" class="show-on-hover btn btn-default" title="Edit Platform"><i class="ion-edit"></i></a></h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div>
                                    <p><label>description: </label> @{{platform.description}}</p>
                                    
                                </div>
                            </header>
                            <hr>
                            <span v-on:click="showNewServerForm(platform.id, $index)" title="Create new server" class="btn btn-default pull-right">New Server</span>
                            <template v-if="platform.servers.length > 0">
                                <h4>Servers</h4>
                                <hr>
                                <table class="table ">
                                    <thead>
                                    <tr>
                                        <td></td>
                                        <td>Name</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="server in platform.servers" class="alert alert-secondary">
                                        <td>@{{ $index + 1 }}</td>
                                        <td><a href="{{ route('servers.show', ['id' => '']) }}/@{{ server.id }}">@{{ server.name }}</a></td>
                                    </tr>
                                   
                                    </tbody>
                                </table>
                            </template>
                            <br>
                            <div class="clearfix"></div>
                            <hr><br><br>
                            <span v-on:click="deletePlatform(platform, $index)" class="btn btn-danger pull-right">Delete @{{ platform.name }}</span>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </template>

    <template v-if="platforms.length == 0">
        <div class="clearfix"></div>
        <p class="alert alert-warning">
            Your platforms will be listed here once you create some.
            Create a new platform <a v-on:click="showCreateForm()">now</a>.
        </p>
    </template>

	{{-- FORMS --}}
	<div class="popup-form new-platform">
		<header>
			<p class="pull-left">New Platform</p>
			<div class="actions pull-right">
				<i title="Minimze "class="ion-minus-round"></i>
				<i title="Close" class="ion-close-round"></i>
			</div>
			<div class="clearfix"></div>
		</header>
		<section>
			<form>
				<span v-if="msg.success != null" class="status-msg success-msg">@{{ msg.success }}</span>
				<span v-if="msg.error != null" class="status-msg error-msg">@{{ msg.error }}</span>
				<input v-model="platform.name" placeholder="Platform Name" type="text" class="form-control first">
				<input v-model="platform.description" placeholder="Descritpion" type="text" class="form-control">
				
			</form>
		</section>
		<footer>
			<a v-on:click="create(platform,true)" class="btn btn-primary pull-right" style="color: #fff;">Save</a>
			<div class="clearfix"></div>
		</footer>
	</div>
	<div class="popup-form new-server">
		<header>
			<p class="pull-left">New Server</p>
			<div class="actions pull-right">
				<i title="Minimze "class="ion-minus-round"></i>
				<i title="Close" class="ion-close-round"></i>
			</div>
			<div class="clearfix"></div>
		</header>
		<section>
			<form>
                <span v-if="msg.success != null" class="status-msg success-msg">@{{ msg.success }}</span>
                <span v-if="msg.error != null" class="status-msg error-msg">@{{ msg.error }}</span>
				<input v-model="newServer.name" placeholder="Name" type="text" class="form-control first">
			</form>
		</section>
		<footer>
			<a v-on:click="createServer(true)" class="btn btn-primary pull-right" style="color: #fff;">Save</a>
			<div class="clearfix"></div>
		</footer>
	</div>
	<div style="z-index: 20" class="popup-form update-platform">
        <header>
            <p class="pull-left">Update Platform</p>
            <div class="actions pull-right">
                <i title="Minimze "class="ion-minus-round"></i>
                <i title="Close" class="ion-close-round"></i>
            </div>
            <div class="clearfix"></div>
        </header>
        <section>
            <form>
                <span v-if="msg.success != null" class="status-msg success-msg">@{{ msg.success }}</span>
                <span v-if="msg.error != null" class="status-msg error-msg">@{{ msg.error }}</span>
                <span class="status-msg"></span>
                <input v-model="currentPlatform.name" placeholder="Platform Name" type="text" class="form-control first">
                <input v-model="currentPlatform.description" placeholder="Description" type="text" class="form-control">
        
            </form>
        </section>
        <footer>
            <a v-on:click="updatePlatform()" class="btn btn-primary pull-right" style="color: #fff;">Update</a>
            <div class="clearfix"></div>
        </footer>
	</div>
</div>


	<script src="{{ asset('assets/js/controllers/platform.js') }}"></script>
@stop()