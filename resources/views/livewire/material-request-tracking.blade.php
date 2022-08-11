@push('extended-css')
    @include('vendors.toastr')
    <style>
        /* ================ The Timeline ================ */

        .timeline {
            position: relative;
            width: 660px;
            margin: 0 auto;
            margin-top: 20px;
            padding: 1em 0;
            list-style-type: none;
        }

        .timeline:before {
            position: absolute;
            left: 50%;
            top: 0;
            content: ' ';
            display: block;
            width: 6px;
            height: 100%;
            margin-left: -3px;
            background: rgb(80, 80, 80);
            background: -moz-linear-gradient(top, rgba(80, 80, 80, 0) 0%, rgb(80, 80, 80) 8%, rgb(80, 80, 80) 92%, rgba(80, 80, 80, 0) 100%);
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgba(30, 87, 153, 1)), color-stop(100%, rgba(125, 185, 232, 1)));
            background: -webkit-linear-gradient(top, rgba(80, 80, 80, 0) 0%, rgb(80, 80, 80) 8%, rgb(80, 80, 80) 92%, rgba(80, 80, 80, 0) 100%);
            background: -o-linear-gradient(top, rgba(80, 80, 80, 0) 0%, rgb(80, 80, 80) 8%, rgb(80, 80, 80) 92%, rgba(80, 80, 80, 0) 100%);
            background: -ms-linear-gradient(top, rgba(80, 80, 80, 0) 0%, rgb(80, 80, 80) 8%, rgb(80, 80, 80) 92%, rgba(80, 80, 80, 0) 100%);
            background: linear-gradient(to bottom, rgba(80, 80, 80, 0) 0%, rgb(80, 80, 80) 8%, rgb(80, 80, 80) 92%, rgba(80, 80, 80, 0) 100%);

            z-index: 5;
        }

        .timeline li {
            padding: 1em 0;
        }

        .timeline li:after {
            content: "";
            display: block;
            height: 0;
            clear: both;
            visibility: hidden;
        }

        .direction-l {
            position: relative;
            width: 300px;
            float: left;
            text-align: right;
        }

        .direction-r {
            position: relative;
            width: 300px;
            float: right;
        }

        .flag-wrapper {
            position: relative;
            display: inline-block;

            text-align: center;
        }

        .flag {
            position: relative;
            display: inline;
            background: rgb(248, 248, 248);
            padding: 6px 10px;
            border-radius: 5px;

            font-weight: 600;
            text-align: left;
        }

        .direction-l .flag {
            -webkit-box-shadow: -1px 1px 1px rgba(0, 0, 0, 0.15), 0 0 1px rgba(0, 0, 0, 0.15);
            -moz-box-shadow: -1px 1px 1px rgba(0, 0, 0, 0.15), 0 0 1px rgba(0, 0, 0, 0.15);
            box-shadow: -1px 1px 1px rgba(0, 0, 0, 0.15), 0 0 1px rgba(0, 0, 0, 0.15);
        }

        .direction-r .flag {
            -webkit-box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.15), 0 0 1px rgba(0, 0, 0, 0.15);
            -moz-box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.15), 0 0 1px rgba(0, 0, 0, 0.15);
            box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.15), 0 0 1px rgba(0, 0, 0, 0.15);
        }

        .direction-l .flag:before,
        .direction-r .flag:before {
            position: absolute;
            top: 50%;
            right: -35px;
            content: ' ';
            display: block;
            width: 12px;
            height: 12px;
            margin-top: -10px;
            background: #fff;
            border-radius: 10px;
            border: 4px solid rgb(247, 39, 39);
            z-index: 10;
        }

        .direction-r .flag:before {
            left: -36px;
        }

        .direction-l .flag:after {
            content: "";
            position: absolute;
            left: 100%;
            top: 50%;
            height: 0;
            width: 0;
            margin-top: -8px;
            border: solid transparent;
            border-left-color: rgb(248, 248, 248);
            border-width: 8px;
            pointer-events: none;
        }

        .direction-r .flag:after {
            content: "";
            position: absolute;
            right: 100%;
            top: 50%;
            height: 0;
            width: 0;
            margin-top: -8px;
            border: solid transparent;
            border-right-color: rgb(248, 248, 248);
            border-width: 8px;
            pointer-events: none;
        }

        .time-wrapper {
            display: inline;

            line-height: 1em;
            font-size: 0.66666em;
            color: rgb(250, 80, 80);
            vertical-align: middle;
        }

        .direction-l .time-wrapper {
            float: left;
        }

        .direction-r .time-wrapper {
            float: right;
        }

        .time {
            display: inline-block;
            padding: 4px 6px;
            background: rgb(248, 248, 248);
        }

        .desc {
            margin: 1em 0.75em 0 0;

            font-size: 0.77777em;
            font-style: italic;
            line-height: 1.5em;
        }

        .direction-r .desc {
            margin: 1em 0 0 0.75em;
        }

        /* ================ Timeline Media Queries ================ */

        @media screen and (max-width: 660px) {

            .timeline {
                width: 100%;
                padding: 4em 0 1em 0;
            }

            .timeline li {
                padding: 2em 0;
            }

            .direction-l,
            .direction-r {
                float: none;
                width: 100%;

                text-align: center;
            }

            .flag-wrapper {
                text-align: center;
            }

            .flag {
                background: rgb(255, 255, 255);
                z-index: 15;
            }

            .direction-l .flag:before,
            .direction-r .flag:before {
                position: absolute;
                top: -30px;
                left: 50%;
                content: ' ';
                display: block;
                width: 12px;
                height: 12px;
                margin-left: -9px;
                background: #fff;
                border-radius: 10px;
                border: 4px solid rgb(255, 80, 80);
                z-index: 10;
            }

            .direction-l .flag:after,
            .direction-r .flag:after {
                content: "";
                position: absolute;
                left: 50%;
                top: -8px;
                height: 0;
                width: 0;
                margin-left: -8px;
                border: solid transparent;
                border-bottom-color: rgb(255, 255, 255);
                border-width: 8px;
                pointer-events: none;
            }

            .time-wrapper {
                display: block;
                position: relative;
                margin: 4px 0 0 0;
                z-index: 14;
            }

            .direction-l .time-wrapper {
                float: none;
            }

            .direction-r .time-wrapper {
                float: none;
            }

            .desc {
                position: relative;
                margin: 1em 0 0 0;
                padding: 1em;
                background: rgb(245, 245, 245);
                -webkit-box-shadow: 0 0 1px rgba(0, 0, 0, 0.20);
                -moz-box-shadow: 0 0 1px rgba(0, 0, 0, 0.20);
                box-shadow: 0 0 1px rgba(0, 0, 0, 0.20);

                z-index: 15;
            }

            .direction-l .desc,
            .direction-r .desc {
                position: relative;
                margin: 1em 1em 0 1em;
                padding: 1em;

                z-index: 15;
            }

        }

        @media screen and (min-width: 400px ?? max-width: 660px) {

            .direction-l .desc,
            .direction-r .desc {
                margin: 1em 4em 0 4em;
            }

        }
    </style>
@endpush
<div>
    <x-bread-crumb-component :modal=false />

    <!-- The Timeline -->

    <ul class="timeline">
        <!-- Item 1 -->
        <li>
            <div class="direction-r">
                <div class="flag-wrapper">
                    <span class="flag">Team Lead Or HR</span>
                    <span class="time-wrapper">
                        <span class="time"
                            @if (array_key_exists(0, $steps)) @if ($steps[0]['status'])
                            style="color:green"
                            @else
                            style="color:red" @endif
                            @endif
                            >{{ array_key_exists(0, $steps) ? ($steps[0]['status'] ? 'Approved' : 'Declined') : 'Waiting for approval' }}
                        </span>
                    </span>
                </div>
                <div class="desc">
                    {{ array_key_exists(0, $steps) ? $steps[0]['comments'] ?? 'No comments' : 'Waiting for approval' }}
                </div>
            </div>
        </li>
        <li>
            <div class="direction-l">
                <div class="flag-wrapper">
                    <span class="flag">CEO</span>
                    <span class="time-wrapper">
                        <span class="time"
                            @if (array_key_exists(1, $steps)) @if ($steps[1]['status'])
                            style="color:green"
                            @else
                            style="color:red" @endif
                            @endif
                            >{{ array_key_exists(1, $steps) ? ($steps[1]['status'] ? 'Approved' : 'Declined') : 'Waiting for approval' }}
                        </span>
                    </span>
                </div>
                <div class="desc">
                    {{ array_key_exists(1, $steps) ? $steps[1]['comments'] ?? 'No comments' : 'Waiting for approval' }}
                </div>
            </div>
        </li>

        <li>
            <div class="direction-r">
                <div class="flag-wrapper">
                    <span class="flag">Admin</span>
                    <span class="time-wrapper">
                        <span class="time"
                            @if (array_key_exists(2, $steps)) @if ($steps[2]['status'])
                            style="color:green"
                            @else
                            style="color:red" @endif
                            @endif
                            >{{ array_key_exists(2, $steps) ? ($steps[2]['status'] ? 'Approved' : 'Declined') : 'Waiting for approval' }}
                        </span>
                    </span>
                </div>
                <div class="desc">
                    {{ array_key_exists(2, $steps) ? $steps[2]['comments'] ?? 'No comments' : 'Waiting for approval' }}
                </div>
            </div>
        </li>

        <li>
            <div class="direction-l">
                <div class="flag-wrapper">
                    <span class="flag">Finance Department</span>
                    <span class="time-wrapper">
                        <span class="time"
                            @if (array_key_exists(3, $steps)) @if ($steps[3]['status'])
                            style="color:green"
                            @else
                            style="color:red" @endif
                            @endif
                            >{{ array_key_exists(3, $steps) ? ($steps[3]['status'] ? 'Approved' : 'Declined') : 'Waiting for approval' }}
                        </span>
                    </span>
                </div>
                <div class="desc">
                    {{ array_key_exists(3, $steps) ? $steps[3]['comments'] ?? 'No comments' : 'Waiting for approval' }}
                </div>
            </div>
        </li>

    </ul>


</div>