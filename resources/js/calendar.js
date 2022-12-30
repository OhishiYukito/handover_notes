import { Calendar } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";
import timeGridPlugin from "@fullcalendar/timegrid";
import listPlugin from "@fullcalendar/list";
import axios from 'axios';

var calendarEl = document.getElementById("calendar");

let calendar = new Calendar(calendarEl, {
    plugins: [interactionPlugin, dayGridPlugin, timeGridPlugin, listPlugin],
    initialView: "dayGridMonth",
    headerToolbar: {
        left: "prev,next today",
        center: "title",
        right: "",
    },
    locale: "ja",
    
    // get event info from database
    events: function (info, successCallback, failureCallback) {
        // call get process
        axios
            .post("/calendar/schedule-get", {
                start_date: info.start.valueOf(),
                end_date: info.end.valueOf(),
            })
            .then((response) => {
                // remove all events on calendar
                calendar.removeAllEvents();
                // add events gotten from database
                successCallback(response.data);
            })
            .catch(error => {
                console.log(error.response)
            });
              //() => {
                // error
                //alert("取得に失敗しました");
            //});
    },
    
    // click on a date or specify a range
    selectable: true,
    select: function (info) {
        // input dialog
        const eventName = prompt("イベントを入力してください");
        
        if (eventName) {
            // call registration process (regist to database)
            axios
                .post("/calendar/schedule-add", {
                    start_date: info.start.valueOf(),
                    end_date: info.end.valueOf(),
                    event_name: eventName,
                })
                .then((response) => {
                    // show added event
                    console.log(response);
                    calendar.addEvent({
                        title: eventName,
                        start: info.start,
                        end: info.end,
                        id: response.data,
                        allDay: true,
                    });
                })
                .catch(() => {
                    // error
                    alert("登録に失敗しました");
                });
        }
    },
    
    // edit event's period
    editable: true,
    eventResize: function (info) {
        // call get process
        axios
            .post("/calendar/schedule-edit-period", {
                start_date: info.event.start.valueOf(),
                end_date: info.event.end.valueOf(),
                event_id: info.event.id.valueOf(),
            })
            .then((response) => {
                
            })
            .catch(() => {
                // error
                alert("更新に失敗しました");
            });
    },
    
    // delete an event
    eventClick: function (info) {
        var request = window.confirm("このイベントを削除しますか?");
        console.log("url " + info.event.id);
        if (request) {
            axios
                .delete("/calendar/schedule-delete", { 
                    data: {event_id: info.event.id}
                })
                .then(() => {
                    var event = calendar.getEventById(info.event.id);
                    event.remove();
                })
                .catch(() => {
                    // error
                    alert("削除に失敗しました");
                });
        }
    }
    
});
calendar.render();