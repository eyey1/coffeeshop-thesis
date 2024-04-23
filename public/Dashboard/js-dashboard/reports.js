var isSalesTableVisible = false;
var isInventoryTableVisible = false;
var isFeedbackTableVisible = false;

function showReport(reportType) {
  if (reportType === 'sales') {
    isSalesTableVisible = !isSalesTableVisible;
    $("#salesReportContainer").toggle(isSalesTableVisible);
    $(".search-filter").toggle(isSalesTableVisible);
    fetchDataAndDisplay('sales');
   
    $("#inventoryReportContainer").hide();
    $("#feedbackReportContainer").hide();
  } else if (reportType === 'inventory') {
    isInventoryTableVisible = !isInventoryTableVisible;
    $("#inventoryReportContainer").toggle(isInventoryTableVisible);
    $(".search-filter").toggle(isInventoryTableVisible);
    fetchDataAndDisplay('inventory');
    
    $("#salesReportContainer").hide();
    $("#feedbackReportContainer").hide();
  } else if (reportType === 'feedback') {
    isFeedbackTableVisible = !isFeedbackTableVisible;
    $("#feedbackReportContainer").toggle(isFeedbackTableVisible);
    $(".search-filter").toggle(!isFeedbackTableVisible);
    fetchDataAndDisplay('feedback');
    
    $("#salesReportContainer").hide();
    $("#inventoryReportContainer").hide();
  }
}

 
function downloadPDF(containerId) {
var container = document.getElementById(containerId);
if (container) {
  var contentToPrint = container.cloneNode(true); 
  
  $(contentToPrint).find('.search-filter, .download-btn').remove();

  var printWindow = window.open('', '', 'height=400,width=800');
  printWindow.document.write('<html><head><title>PDF Export</title>');
  printWindow.document.write('<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">'); 
  printWindow.document.write('<style>');
  printWindow.document.write(`
    .container { margin-top: 20px; }
    .table { border-collapse: collapse; width: 100%; }
    .table th, .table td { border: 1px solid #dee2e6; padding: 8px; }
    .table th { background-color: #f8f9fa; }
    .text-center { text-align: center; }
    .table-responsive { overflow-x: hidden; } /* Disable horizontal scrolling */
    .table-responsive table { width: auto; } /* Set table width to auto */
  `); 
  printWindow.document.write('</style></head><body>');
  printWindow.document.write(contentToPrint.innerHTML); 
  printWindow.document.write('</body></html>');
  printWindow.document.close();
  printWindow.print();
} else {
  console.error("Container element not found.");
}
}



function filterTable(reportType) {
  var filterId, tableBodyId, startDateId, endDateId;

  if (reportType === 'sales') {
    filterId = 'filterDropdownSales';
    tableBodyId = 'tableBodySales';
    startDateId = 'startDateSales';
    endDateId = 'endDateSales';
  } else if (reportType === 'inventory') {
    filterId = 'quantityFilterInventory';
    tableBodyId = 'inventoryTableBody';
  }

  var filterValue = $("#" + filterId).val();
  var startDate = $("#" + startDateId).val();
  var endDate = $("#" + endDateId).val();

  fetchDataAndDisplay(reportType, filterValue, startDate, endDate);
}

function searchSales() {
var filterValue = $("#filterDropdownSales").val();
var startDate = $("#startDateSales").val();
var endDate = $("#endDateSales").val();

fetchDataAndDisplay('sales', filterValue, startDate, endDate);
}



function displayInventoryReport(data) {
  $("#inventoryTableBody").empty();

  for (var i = 0; i < data.length; i++) {
    var row = "<tr>";
    row += "<td>" + data[i].inventory_id + "</td>";
    row += "<td>" + data[i].inventory_item + "</td>";
    row += "<td>" + data[i].item_type + "</td>";
    row += "<td>" + data[i].quantity + "</td>";
    row += "<td>" + data[i].unit + "</td>";
    row += "<td>" + data[i].supplier_id + "</td>";
    row += "<td>" + data[i].product_id + "</td>";
    row += "</tr>";

    $("#inventoryTableBody").append(row);
  }
}

function displayFeedbackReport(data) {
  $("#tableBodyFeedback").empty();

  for (var i = 0; i < data.length; i++) {
    var row = "<tr>";
    row += "<td>" + data[i].feedbackid + "</td>";
    row += "<td>" + data[i].title + "</td>";

    var fullDescription = data[i].feedback_desc;
    var truncatedDescription = truncateDescription(fullDescription, 100);

    row += "<td class='feedback-description' data-full-description='" + escapeHtml(fullDescription) + "'>" + truncatedDescription + "</td>";
    row += "<td>" + data[i].customerid + "</td>";
    row += "</tr>";

    $("#tableBodyFeedback").append(row);
  }
}

function truncateDescription(description, maxLength) {
  if (description.length > maxLength) {
    var truncated = description.substring(0, maxLength);
    return truncated + "<span class='show-more' onclick='showFullDescription(this)'> Show More</span>";
  } else {
    return description;
  }
}

function showFullDescription(element) {
  var tdElement = $(element).parent();
  var fullDescription = tdElement.data('full-description');

  var fullDescriptionDiv = $("<div>").addClass('full-description').html(fullDescription);

  tdElement.append(fullDescriptionDiv);

  tdElement.css({
    'max-width': '20px',
    'overflow': 'hidden',
  });

  tdElement.find('.original-content').hide();

  $(element).hide();

  tdElement.append("<span class='show-less' onclick='showLessDescription(this)'> Show Less</span>");
}

function showLessDescription(element) {
  var tdElement = $(element).parent();

  tdElement.find('.original-content').show();

  tdElement.find('.show-more').show();

  $(element).hide();

  tdElement.find('.full-description').remove();

  tdElement.css({
    'max-width': 'none',
    'overflow': 'visible',
  });
}

function escapeHtml(text) {
  var div = document.createElement('div');
  div.textContent = text;
  return div.innerHTML;
}


function fetchDataAndDisplay(reportType, filterValue, startDate, endDate) {
  var url;

  if (reportType === 'sales') {
    url = '/admin_dashboard/reports?get_sales_data';

    if (startDate && endDate) {
      url += '&startDate=' + startDate + '&endDate=' + endDate;
    }
    if (filterValue && filterValue !== 'all') {
      url += '&paymentType=' + filterValue; // Include paymentType filter parameter
    }
  } else if (reportType === 'inventory') {
    url = '/admin_dashboard/reports?get_inventory_data';
  } else if (reportType === 'feedback') {
    url = '/admin_dashboard/reports?get_feedback_data';
  } else {
    console.error('Invalid report type: ' + reportType);
    return; // Exit function if reportType is not recognized
  }

  $.get(url, function(data) {
    var reportData = JSON.parse(data);
    console.log('Data received:', reportData); // Debug log to check the data received

    if (reportType === 'sales') {
      displaySalesReport(reportData);
    } else if (reportType === 'inventory') {
      displayInventoryReport(reportData);
    } else if (reportType === 'feedback') {
      displayFeedbackReport(reportData);
    }
  });
}


function displaySalesReport(data) {
  $("#tableBodySales").empty();
  
  // Sort data based on payment type
  data.sort(function(a, b) {
    var paymentTypeA = a.paymenttype.toUpperCase(); 
    var paymentTypeB = b.paymenttype.toUpperCase(); 
    if (paymentTypeA < paymentTypeB) {
      return -1;
    } else if (paymentTypeA > paymentTypeB) {
      return 1;
    } else {
      return 0;
    }
  });

  // Iterate through sorted data and append rows to the table
  for (var i = 0; i < data.length; i++) {
    var row = "<tr>";
    row += "<td>" + data[i].paymentID + "</td>";
    row += "<td>" + data[i].order_datetime + "</td>";
    row += "<td>" + data[i].amountpayed + "</td>";
    row += "<td>" + data[i].paymenttype + "</td>";
    row += "<td>" + data[i].customerid + "</td>";
    row += "<td>" + data[i].orderid + "</td>";
    row += "</tr>";

    $("#tableBodySales").append(row);
  }
}

