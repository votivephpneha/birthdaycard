<style type="text/css">
#progressbar {
    margin-bottom: 31px;
    overflow: hidden;
    color: lightgrey;
    margin-top: 31px;
}

#progressbar .active {
	color: #ff0091
}

#progressbar li {
    list-style-type: none;
    font-size: 13px;
    width: 16.66%;
    float: left;
    position: relative;
    font-weight: 400;
    text-align: center;
}

#progressbar #step1:before {
	content: "1"
}

#progressbar #step2:before {
	content: "2"
}


#progressbar #step3:before {
	content: "3"
}

#progressbar #step4:before {
	content: "4"
}

#progressbar #step5:before {
	content: "5"
}

#progressbar #step6:before {
	content: "6"
}

#progressbar li:before {
    width: 35px;
    height: 35px;
    line-height: 36px;
    display: block;
    font-size: 13px;
    color: #ffffff;
    background: lightgray;
    border-radius: 50%;
    margin: 0 auto 10px auto;
    padding: 2px;
    z-index: 9;
    text-align: center;
    position: relative;
}

#progressbar li:after {
    content: '';
    width: 100%;
    height: 2px;
    background: lightgray;
    position: absolute;
    left: 0;
    top: 18px;
    z-index: 1;
}

#progressbar li.active:before,
#progressbar li.active:after {
	background: #ff0091
}

.progress {
	height: 20px
}

.progress-bar {
	background-color: #2F8D46
}

</style>
<ul id="progressbar">
	@if($track_order_data->order_status == '0')
	<li class="active" id="step1">
		<strong>Ordered</strong>
	</li>
	<li id="step2"><strong>In Progress</strong></li>
	<li id="step3"><strong>Order Ready</strong></li>
	<li id="step4"><strong>In Transit</strong></li>
	<li id="step5"><strong>Out for delivery</strong></li>
	<li id="step6"><strong>Delivered</strong></li>
	@endif
	@if($track_order_data->order_status == '1')
	<li class="active" id="step1">
		<strong>Ordered</strong>
	</li>
	<li class="active" id="step2"><strong>In Progress</strong></li>
	<li id="step3"><strong>Order Ready</strong></li>
	<li id="step4"><strong>In Transit</strong></li>
	<li id="step5"><strong>Out for delivery</strong></li>
	<li id="step6"><strong>Delivered</strong></li>
	@endif
	@if($track_order_data->order_status == '3')
	<li class="active" id="step1">
		<strong>Ordered</strong>
	</li>
	<li class="active" id="step2"><strong>In Progress</strong></li>
	<li class="active" id="step3"><strong>Order Ready</strong></li>
	<li id="step4"><strong>In Transit</strong></li>
	<li id="step5"><strong>Out for delivery</strong></li>
	<li id="step6"><strong>Delivered</strong></li>
	@endif
	@if($track_order_data->order_status == '4')
	<li class="active" id="step1">
		<strong>Ordered</strong>
	</li>
	<li class="active" id="step2"><strong>In Progress</strong></li>
	<li class="active" id="step3"><strong>Order Ready</strong></li>
	<li class="active" id="step4"><strong>In Transit</strong></li>
	<li id="step5"><strong>Out for delivery</strong></li>
	<li id="step6"><strong>Delivered</strong></li>
	@endif
	@if($track_order_data->order_status == '5')
	<li class="active" id="step1">
		<strong>Ordered</strong>
	</li>
	<li class="active" id="step2"><strong>In Progress</strong></li>
	<li class="active" id="step3"><strong>Order Ready</strong></li>
	<li class="active"id="step4"><strong>In Transit</strong></li>
	<li class="active" id="step5"><strong>Out for delivery</strong></li>
	<li id="step6"><strong>Delivered</strong></li>
	@endif

	@if($track_order_data->order_status == '6')
	<li class="active" id="step1">
		<strong>Ordered</strong>
	</li>
	<li class="active" id="step2"><strong>In Progress</strong></li>
	<li class="active" id="step3"><strong>Order Ready</strong></li>
	<li class="active"id="step4"><strong>In Transit</strong></li>
	<li class="active" id="step5"><strong>Out for delivery</strong></li>
	<li class="active" id="step6"><strong>Delivered</strong></li>
	@endif
</ul>