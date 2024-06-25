// call js to get branch list when user login
$.ajax({
  url: "/api/branch",
  type: "GET",
  success: function (response) {
    // Check if the response is an array
    if (Array.isArray(response)) {
        response.forEach(function (branch) {
            $('#branch-list').append('<a href="#" class="list-group-item list-group-item-action">' + branch.name + '</a>');
        });
    } else {    
        console.error('Unexpected response format:', response);
    }    
  },
});
