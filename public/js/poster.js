/**
 * Created by samuel on 11/1/2017.
 */

function update_title() {
    var title = $("#f_title").val();
    $("#m-title").html(title);
}

function update_deceased_name() {
    var dname = $("#dname").val();
    $("#m_dname").html(dname);
}

function update_deceased_age() {
    var age = $("#dage").val();
    $("#m_dage").html(age);
}

function update_info() {
    var info = $("#info").val();
    $("#m_information").html(info);
}
