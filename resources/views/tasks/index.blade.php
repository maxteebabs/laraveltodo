@extends('layouts.master')
@section('content')
@include('layouts.nav')
<div class="row">
    <div class="col-md-3">
        <div class="left-menu">
            <div class="left-menu-inner">
                <ul>
                    <li><a @click.prevent="setCategory('My Day')" 
                        href="javascript:void(0);"><i class="fa fa-sun-o" aria-hidden="true"></i> My Day</a></li>
                    <li><a @click.prevent="setCategory('Important')" 
                        href="javascript:void(0);"><i class="fa fa-bookmark" aria-hidden="true"></i> Important</a></li>
                    <li><a @click.prevent="setCategory('Planned')" 
                        href="javascript:void(0);"><i class="fa fa-calendar" aria-hidden="true"></i> Planned</a></li>
                    <li><a @click.prevent="setCategory('')" 
                        href="javascript:void(0);"><i class="fa fa-tasks" aria-hidden="true"></i> All Tasks</a></li>
                    <li><a href="javascript:void(0);" 
                        data-toggle="modal" data-target="#createTask"> <i class="fa fa-plus"></i> New Task</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="content-wrapper">
            <h2>My Task</h2><hr />
            <ul class="pagination">
                <li  v-show="current_page > 1"><a class="page-link" href="#" 
                    @click.prevent="prev()">&laquo; Prev</a></li>
                <li v-show="current_page < total_pages"><a class="page-link" href="#" 
                    @click.prevent="next()">Next &raquo;</a></li>
            </ul>
            <table class="table table-bordered table-striped table-condensed">
                <tr>
                    <th>Title</th>
                    <th>Note</th>
                    <th>Status</th>
                    <th></th>
                </tr>
                <tbody v-if="tasks.length">
                    <tr v-for="task in tasks">
                        <td style="width:30%">%%task.title%%</td>
                        <td style="width:40%">%%task.note%%</td>
                        <td  style="width:15%">
                            <span v-if="task.is_completed == 1">Done</span>
                            <span v-else>Pending</span>
                        </td>
                        <td  style="width:15%">
                            <button class="btn btn-secondary" :data-id="task.id" 
                                @click="populateModal(task)"
                                data-toggle="modal" data-target="#editTask" title="Edit Task">
                                <i class="fa fa-pencil"></i>
                            </button>
                            <button class="btn btn-danger" @click.prevent="removeTask(task)"
                                 title="Delete Task">
                                <i class="fa fa-trash"></i>
                            </button>
                            <button class="btn btn-primary" v-show="task.is_completed == 0"
                                @click.prevent="markAsCompleted(task)" title="Mark As Completed">
                                <i class="fa fa-check"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
                <tbody v-else>
                    <tr>
                        <td colspan="4"><center>No Record found</center></td>
                    </tr>
                </tbody>
                
            </table>
        </div>
    </div>
</div>

<!-- Create Task Modal -->
<div class="modal fade" id="createTask" tabindex="-1" role="dialog" 
    aria-labelledby="createTaskodalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add a Task</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" v-model="item.title"
                        aria-describedby="title" placeholder="Enter Title" />
                    <span v-show="error.title" class="help-block error">%%error.title%%</span>
                </div>
                <div class="form-group">
                    <label for="tag">Tags</label>
                    <select class="form-control" id="tag" name="tag" v-model="item.tags">
                        <option></option>
                        <option value="Planned">Planned</option>
                        <option value="My Day">My Day</option>
                        <option value="Important">Important</option>
                    </select>
                    <span v-show="error.tags" class="help-block error">%%error.tags%%</span>
                </div>
                <div class="form-group">
                    <label for="note">Note</label>
                    <textarea name="note" v-model="item.note" class="form-control" id="note" placeholder="Add Note"></textarea>
                </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" @click.prevent="postTask()">Submit</button>
      </div>
    </div>
  </div>
</div>

<!-- Edit Task Modal -->
<div class="modal fade" id="editTask" tabindex="-1" role="dialog" 
    aria-labelledby="createTaskodalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Task</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" v-model="item.title"
                        aria-describedby="title" placeholder="Enter Title" />
                    <span v-show="error.title" class="help-block error">%%error.title%%</span>
                </div>
                <div class="form-group">
                    <label for="tag">Tags</label>
                    <select class="form-control" id="tag" name="tag" v-model="item.tags">
                        <option></option>
                        <option value="Planned">Planned</option>
                        <option value="My Day">My Day</option>
                        <option value="Important">Important</option>
                    </select>
                    <span v-show="error.tags" class="help-block error">%%error.tags%%</span>
                </div>
                <div class="form-group">
                    <label for="note">Note</label>
                    <textarea name="note" v-model="item.note" class="form-control" id="note" placeholder="Add Note"></textarea>
                </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" @click.prevent="updateTask()">Save Changes</button>
      </div>
    </div>
  </div>
</div>

@endsection
