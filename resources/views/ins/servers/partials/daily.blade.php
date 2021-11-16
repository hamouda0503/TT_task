<div class="row task-list-row">
    <div class="col-xs-12">
        <ul class="task-list daily">
            <h5 class="title">Daily (@{{ numDailyTasks }})</h5>
            <li v-on:click="editMode(task)" v-for="task in server.tasks | filterBy 'daily' in 'state' " class="task-@{{ task.id }}" >
                <div>
                    <div class="pull-left">w.@{{ task.weight }}</div>
                    <div class="show-on-hover pull-right">
                        <span v-on:click="deleteTask(task.id, $index)" class="ion-close-round"></span>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div>
                    <h5>@{{ task.name }}</h5>
                    <span class="priority-circle priority-@{{ task.priority }}"></span>
                    <span v-if="task.description.length != 0" class="ion-android-textsms"></span>
                    <div class="pull-right">Due Date : @{{ task.dueDate }}</div>
                </div>
            </li>
        </ul>
    </div>
</div>