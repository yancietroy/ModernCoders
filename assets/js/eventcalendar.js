var calendar;
var Calendar = FullCalendar.Calendar;
var events = [];
$(function () {
  if (!!scheds) {
    Object.keys(scheds).map((k) => {
      var row = scheds[k];
      events.push({
        id: row.project_id,
        title: row.project_name,
        start: row.start_date,
        end: row.end_date,
      });
    });
  }
  var date = new Date();
  var d = date.getDate(),
    m = date.getMonth(),
    y = date.getFullYear();

  calendar = new Calendar(document.getElementById("calendar"), {
    headerToolbar: {
      left: "prev,next today",
      right: "dayGridMonth,dayGridWeek,list",
      center: "title",
    },
    selectable: true,
    themeSystem: "bootstrap5",
    // Random default events
    events: events,
    eventClick: function (info) {
      var _details = $("#event-details-modal");
      var id = info.event.id;
      if (!!scheds[id]) {
        _details.find("#project_name").text(scheds[id].project_name);
        _details.find("#project_desc").text(scheds[id].project_desc);
        _details.find("#start").text(scheds[id].sdate);
        _details.find("#end").text(scheds[id].edate);
        _details.find("#edit,#delete").attr("data-id", id);
        _details.modal("show");
      } else {
        alert("Event is undefined");
      }
    },
    eventDidMount: function (info) {
      // Do Something after events mounted
    },
    editable: true,
  });

  calendar.render();

  // Form reset listener
  $("#schedule-form").on("reset", function () {
    $(this).find("input:hidden").val("");
    $(this).find("input:visible").first().focus();
  });

  // Edit Button
  $("#edit").click(function () {
    var id = $(this).attr("data-id");
    if (!!scheds[id]) {
      var _form = $("#schedule-form");
      console.log(
        String(scheds[id].start_date),
        String(scheds[id].start_date).replace(" ", "\\t")
      );
      _form.find('[name="project_id"]').val(id);
      _form.find('[name="project_name"]').val(scheds[id].project_name);
      _form.find('[name="project_desc"]').val(scheds[id].project_desc);
      _form
        .find('[name="start_date"]')
        .val(String(scheds[id].start_date).replace(" ", "T"));
      _form
        .find('[name="end_date"]')
        .val(String(scheds[id].end_date).replace(" ", "T"));
      $("#event-details-modal").modal("hide");
      _form.find('[name="project_name"]').focus();
    } else {
      alert("Event is undefined");
    }
  });

  // Delete Button / Deleting an Event
  $("#delete").click(function () {
    var project_id = $(this).attr("data-id");
    if (!!scheds[project_id]) {
      var _conf = confirm("Are you sure to delete this scheduled event?");
      if (_conf === true) {
        location.href = "./delete_schedule.php?project_id=" + project_id;
      }
    } else {
      alert("Event is undefined");
    }
  });
});
