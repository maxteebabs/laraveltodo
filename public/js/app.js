/**
 * @author FAMUREWA TAIWO <famurewa_taiwo@yahoo.com>
 * @date 6th March 2020
 */

var base_url = "http://localhost:8000/api";
window.addEventListener('load', () => {
    'use strict';

    new Vue({
        el: '#app',
        delimiters: ['%%', '%%'],
        data:{
            tasks:[],
            per_page: 20,
            current_page: 1,
            total_pages: 1,
            total:50, 
            current_tag: "My Day",
            item: { id: "", title: "", note: "", tags: "", is_completed: 0 },
            error: { title: "", note: "", tags: "", is_completed: 0 }
        },
        created: function() {
            this.getTasks();
        },
        methods:{
            getTasks: function() {
                var url = `${base_url}/tasks/?page=${this.current_page}&current_tag=${this.current_tag}`;
                axios
                .get(url)
                .then(response => {
                    let result = response.data;
                    this.tasks = result.data;
                    this.per_page = result.per_page;
                    this.total_pages = Math.ceil(this.total / this.per_page);

                    // this.current_page = result.current_page;
                    this.total = result.total;  
                }).catch(function(error) {
                    console.log(error);
                    this.$toastr.success('Failed. Please try again');
                });
            }, 
            postTask: function() {
                var error = false;
                if(this.item.tags == "") {
                    this.error.tags = "The Tag field is required";
                    error = true;
                }
                if (this.item.title == "") {
                    this.error.title = "The Title field is required";
                    error= true;
                }
                if(error) {
                    return false;
                }
                var url = `${base_url}/tasks`;
                axios.defaults.headers.common = {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                };
                axios
                .post(url, this.item)
                .then(response => {
                    this.$toastr.success("Created Successfully");
                    this.getTasks();
                    this.item = { "title": "", note: "", tags: "", is_completed: 0 };
                    $(".modal").hide();
                    $(".modal-backdrop").hide();
                }).catch(function (error) {
                    console.log(error);
                });
            },
            updateTask: function () {
                var error = false;
                if (this.item.tags == "") {
                    this.error.tags = "The Tag field is required";
                    error = true;
                }
                if (this.item.title == "") {
                    this.error.title = "The Title field is required";
                    error = true;
                }
                if (error) {
                    return false;
                }
                var url = `${base_url}/tasks/${this.item.id}`;
                axios.defaults.headers.common = {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                };
                axios
                    .put(url, this.item)
                    .then(response => {
                        this.$toastr.success("Created Successfully");
                        this.getTasks();
                        this.item = { "title": "", note: "", tags: "", is_completed: 0 };
                        $(".modal").hide();
                        $(".modal-backdrop").hide();
                    }).catch(function (error) {
                        console.log(error);
                        this.$toastr.success('Failed. Please try again');
                    });
            },
            removeTask: function(task) {
                var url = `${base_url}/tasks/${task.id}`;
                var data = {};
                axios
                .delete(url, data)
                .then(response => {
                    this.$toastr.success('Deleted Successfully');
                    this.getTasks();
                }).catch(function (error) {
                    console.log(error);
                    this.$toastr.success('Failed. Please try again');
                });
            },
            markAsCompleted: function(task) {
                var c = confirm("Are you sure you want to mark as completed?");
                if(!c) {
                    return false;
                }
                var url = `${base_url}/tasks/mark/${task.id}`;
                axios
                .get(url)
                .then(response => {
                    this.$toastr.success('Successful');
                    this.getTasks();
                }).catch(function (error) {
                    console.log(error);
                    this.$toastr.success('Failed. Please try again');
                });
            },
            setCategory:function(tag) {
                this.current_tag = tag;
                this.getTasks();
            },
            populateModal(task) {
                this.item.id = task.id;
                this.item.title = task.title;
                this.item.note = task.note;
                this.item.tags = task.tags;
                this.item.is_completed = task.is_completed;
            },
            prev() {
                this.current_page--;
                if(this.current_page < 1) {
                    this.current_page = 1;
                }
                this.getTasks();
            },
            next() {
                this.current_page++;
                if(this.current_page > this.total_pages) {
                    this.current_page = this.total_pages;
                }
                this.getTasks();
                console.log(this.current_page, this.total_pages)
            }
         }
    });
});