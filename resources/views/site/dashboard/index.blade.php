@extends('site.layouts.wrapper')

@section('center_content')
    <main class="pb-8">
        <div class="pt-6 px-4">
            <div class="my-4 w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
                <div class="bg-white shadow-lg rounded-lg p-4 sm:p-6 xl:p-8 ">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">2,340</span>
                            <h3 class="text-base font-normal text-gray-500">New products this week</h3>
                        </div>
                        <div class="ml-5 w-0 flex items-center justify-end flex-1 text-green-500 text-base font-bold">
                            14.6%
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="bg-white shadow-lg rounded-lg p-4 sm:p-6 xl:p-8 ">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">5,355</span>
                            <h3 class="text-base font-normal text-gray-500">Visitors this week</h3>
                        </div>
                        <div class="ml-5 w-0 flex items-center justify-end flex-1 text-green-500 text-base font-bold">
                            32.9%
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="bg-white shadow-lg rounded-lg p-4 sm:p-6 xl:p-8 ">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">385</span>
                            <h3 class="text-base font-normal text-gray-500">User signups this week</h3>
                        </div>
                        <div class="ml-5 w-0 flex items-center justify-end flex-1 text-red-500 text-base font-bold">
                            -2.7%
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M14.707 12.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full gap-4">
{{--                <div class="bg-white shadow-lg-lg rounded-lg p-4 sm:p-6 xl:p-8  2xl:col-span-2">--}}
{{--                    <div class="flex items-center justify-between mb-4">--}}
{{--                        <div class="flex-shrink-0">--}}
{{--                            <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">$45,385</span>--}}
{{--                            <h3 class="text-base font-normal text-gray-500">Sales this week</h3>--}}
{{--                        </div>--}}
{{--                        <div class="flex items-center justify-end flex-1 text-green-500 text-base font-bold">--}}
{{--                            12.5%--}}
{{--                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>--}}
{{--                            </svg>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div id="main-chart" style="min-height: 435px;"><div id="apexcharts8invfevc" class="apexcharts-canvas apexcharts8invfevc apexcharts-theme-light" style="width: 519px; height: 420px;"><svg id="SvgjsSvg1533" width="519" height="420" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg apexcharts-zoomable" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG1535" class="apexcharts-inner apexcharts-graphical" transform="translate(70.9391860961914, 30)"><defs id="SvgjsDefs1534"><clipPath id="gridRectMask8invfevc"><rect id="SvgjsRect1541" width="422.55428886413574" height="351.81759814834595" x="-4" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="forecastMask8invfevc"></clipPath><clipPath id="nonForecastMask8invfevc"></clipPath><clipPath id="gridRectMarkerMask8invfevc"><rect id="SvgjsRect1542" width="418.55428886413574" height="351.81759814834595" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath></defs><line id="SvgjsLine1540" x1="0" y1="0" x2="0" y2="347.81759814834595" stroke="#b6b6b6" stroke-dasharray="3" stroke-linecap="butt" class="apexcharts-xcrosshairs" x="0" y="0" width="1" height="347.81759814834595" fill="#b1b9c4" filter="none" fill-opacity="0.9" stroke-width="1"></line><g id="SvgjsG1549" class="apexcharts-xaxis" transform="translate(0, 0)"><g id="SvgjsG1550" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"><text id="SvgjsText1552" font-family="Inter, sans-serif" x="0" y="376.81759814834595" text-anchor="middle" dominant-baseline="auto" font-size="14px" font-weight="500" fill="#6b7280" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Inter, sans-serif;"><tspan id="SvgjsTspan1553">01 Feb</tspan><title>01 Feb</title></text><text id="SvgjsText1555" font-family="Inter, sans-serif" x="69.09238147735596" y="376.81759814834595" text-anchor="middle" dominant-baseline="auto" font-size="14px" font-weight="500" fill="#6b7280" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Inter, sans-serif;"><tspan id="SvgjsTspan1556">02 Feb</tspan><title>02 Feb</title></text><text id="SvgjsText1558" font-family="Inter, sans-serif" x="138.1847629547119" y="376.81759814834595" text-anchor="middle" dominant-baseline="auto" font-size="14px" font-weight="500" fill="#6b7280" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Inter, sans-serif;"><tspan id="SvgjsTspan1559">03 Feb</tspan><title>03 Feb</title></text><text id="SvgjsText1561" font-family="Inter, sans-serif" x="207.27714443206787" y="376.81759814834595" text-anchor="middle" dominant-baseline="auto" font-size="14px" font-weight="500" fill="#6b7280" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Inter, sans-serif;"><tspan id="SvgjsTspan1562">04 Feb</tspan><title>04 Feb</title></text><text id="SvgjsText1564" font-family="Inter, sans-serif" x="276.3695259094238" y="376.81759814834595" text-anchor="middle" dominant-baseline="auto" font-size="14px" font-weight="500" fill="#6b7280" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Inter, sans-serif;"><tspan id="SvgjsTspan1565">05 Feb</tspan><title>05 Feb</title></text><text id="SvgjsText1567" font-family="Inter, sans-serif" x="345.4619073867798" y="376.81759814834595" text-anchor="middle" dominant-baseline="auto" font-size="14px" font-weight="500" fill="#6b7280" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Inter, sans-serif;"><tspan id="SvgjsTspan1568">06 Feb</tspan><title>06 Feb</title></text><text id="SvgjsText1570" font-family="Inter, sans-serif" x="414.55428886413574" y="376.81759814834595" text-anchor="middle" dominant-baseline="auto" font-size="14px" font-weight="500" fill="#6b7280" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Inter, sans-serif;"><tspan id="SvgjsTspan1571">07 Feb</tspan><title>07 Feb</title></text></g><line id="SvgjsLine1572" x1="0" y1="348.81759814834595" x2="414.55428886413574" y2="348.81759814834595" stroke="#f3f4f6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt"></line></g><g id="SvgjsG1589" class="apexcharts-grid"><g id="SvgjsG1590" class="apexcharts-gridlines-horizontal" style="display: none;"><line id="SvgjsLine1599" x1="0" y1="0" x2="414.55428886413574" y2="0" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1600" x1="0" y1="57.96959969139099" x2="414.55428886413574" y2="57.96959969139099" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1601" x1="0" y1="115.93919938278198" x2="414.55428886413574" y2="115.93919938278198" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1602" x1="0" y1="173.90879907417298" x2="414.55428886413574" y2="173.90879907417298" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1603" x1="0" y1="231.87839876556396" x2="414.55428886413574" y2="231.87839876556396" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1604" x1="0" y1="289.84799845695494" x2="414.55428886413574" y2="289.84799845695494" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1605" x1="0" y1="347.81759814834595" x2="414.55428886413574" y2="347.81759814834595" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line></g><g id="SvgjsG1591" class="apexcharts-gridlines-vertical" style="display: none;"></g><line id="SvgjsLine1592" x1="0" y1="348.81759814834595" x2="0" y2="354.81759814834595" stroke="#f3f4f6" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1593" x1="69.09238147735596" y1="348.81759814834595" x2="69.09238147735596" y2="354.81759814834595" stroke="#f3f4f6" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1594" x1="138.1847629547119" y1="348.81759814834595" x2="138.1847629547119" y2="354.81759814834595" stroke="#f3f4f6" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1595" x1="207.27714443206787" y1="348.81759814834595" x2="207.27714443206787" y2="354.81759814834595" stroke="#f3f4f6" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1596" x1="276.3695259094238" y1="348.81759814834595" x2="276.3695259094238" y2="354.81759814834595" stroke="#f3f4f6" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1597" x1="345.4619073867798" y1="348.81759814834595" x2="345.4619073867798" y2="354.81759814834595" stroke="#f3f4f6" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1598" x1="414.55428886413574" y1="348.81759814834595" x2="414.55428886413574" y2="354.81759814834595" stroke="#f3f4f6" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1607" x1="0" y1="347.81759814834595" x2="414.55428886413574" y2="347.81759814834595" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line><line id="SvgjsLine1606" x1="0" y1="1" x2="0" y2="347.81759814834595" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line></g><g id="SvgjsG1543" class="apexcharts-area-series apexcharts-plot-series"><g id="SvgjsG1544" class="apexcharts-series" seriesName="Revenue" data:longestSeries="true" rel="1" data:realIndex="0"><path id="SvgjsPath1547" d="M 0 347.81759814834595L 0 141.44582324699422C 24.182333517074582 141.44582324699422 44.910047960281375 221.4438708211137 69.09238147735596 221.4438708211137C 93.27471499443054 221.4438708211137 114.00242943763733 257.3850226297759 138.1847629547119 257.3850226297759C 162.3670964717865 257.3850226297759 183.09481091499327 42.897503771629545 207.27714443206787 42.897503771629545C 231.45947794914247 42.897503771629545 252.18719239234923 141.44582324699422 276.3695259094238 141.44582324699422C 300.5518594264984 141.44582324699422 321.2795738697052 199.41542293838484 345.4619073867798 199.41542293838484C 369.6442409038544 199.41542293838484 390.37195534706115 315.35462232116697 414.55428886413574 315.35462232116697C 414.55428886413574 315.35462232116697 414.55428886413574 315.35462232116697 414.55428886413574 347.81759814834595M 414.55428886413574 315.35462232116697z" fill="rgba(6,148,162,0.3)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMask8invfevc)" pathTo="M 0 347.81759814834595L 0 141.44582324699422C 24.182333517074582 141.44582324699422 44.910047960281375 221.4438708211137 69.09238147735596 221.4438708211137C 93.27471499443054 221.4438708211137 114.00242943763733 257.3850226297759 138.1847629547119 257.3850226297759C 162.3670964717865 257.3850226297759 183.09481091499327 42.897503771629545 207.27714443206787 42.897503771629545C 231.45947794914247 42.897503771629545 252.18719239234923 141.44582324699422 276.3695259094238 141.44582324699422C 300.5518594264984 141.44582324699422 321.2795738697052 199.41542293838484 345.4619073867798 199.41542293838484C 369.6442409038544 199.41542293838484 390.37195534706115 315.35462232116697 414.55428886413574 315.35462232116697C 414.55428886413574 315.35462232116697 414.55428886413574 315.35462232116697 414.55428886413574 347.81759814834595M 414.55428886413574 315.35462232116697z" pathFrom="M -2072.7714443206787 347.81759814834595L -2072.7714443206787 141.44582324699422C -1927.6774432182312 141.44582324699422 -1803.3111565589904 221.4438708211137 -1658.217155456543 221.4438708211137C -1513.1231543540955 221.4438708211137 -1388.7568676948547 257.3850226297759 -1243.6628665924072 257.3850226297759C -1098.5688654899598 257.3850226297759 -974.202578830719 42.897503771629545 -829.1085777282715 42.897503771629545C -684.014576625824 42.897503771629545 -559.6482899665832 141.44582324699422 -414.55428886413574 141.44582324699422C -269.4602877616883 141.44582324699422 -145.0940011024475 199.41542293838484 0 199.41542293838484C 145.0940011024475 199.41542293838484 269.4602877616883 315.35462232116697 414.55428886413574 315.35462232116697C 414.55428886413574 315.35462232116697 414.55428886413574 315.35462232116697 414.55428886413574 347.81759814834595M 414.55428886413574 315.35462232116697z"></path><path id="SvgjsPath1548" d="M 0 141.44582324699422C 24.182333517074582 141.44582324699422 44.910047960281375 221.4438708211137 69.09238147735596 221.4438708211137C 93.27471499443054 221.4438708211137 114.00242943763733 257.3850226297759 138.1847629547119 257.3850226297759C 162.3670964717865 257.3850226297759 183.09481091499327 42.897503771629545 207.27714443206787 42.897503771629545C 231.45947794914247 42.897503771629545 252.18719239234923 141.44582324699422 276.3695259094238 141.44582324699422C 300.5518594264984 141.44582324699422 321.2795738697052 199.41542293838484 345.4619073867798 199.41542293838484C 369.6442409038544 199.41542293838484 390.37195534706115 315.35462232116697 414.55428886413574 315.35462232116697" fill="none" fill-opacity="1" stroke="#0694a2" stroke-opacity="1" stroke-linecap="butt" stroke-width="4" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMask8invfevc)" pathTo="M 0 141.44582324699422C 24.182333517074582 141.44582324699422 44.910047960281375 221.4438708211137 69.09238147735596 221.4438708211137C 93.27471499443054 221.4438708211137 114.00242943763733 257.3850226297759 138.1847629547119 257.3850226297759C 162.3670964717865 257.3850226297759 183.09481091499327 42.897503771629545 207.27714443206787 42.897503771629545C 231.45947794914247 42.897503771629545 252.18719239234923 141.44582324699422 276.3695259094238 141.44582324699422C 300.5518594264984 141.44582324699422 321.2795738697052 199.41542293838484 345.4619073867798 199.41542293838484C 369.6442409038544 199.41542293838484 390.37195534706115 315.35462232116697 414.55428886413574 315.35462232116697" pathFrom="M -2072.7714443206787 141.44582324699422C -1927.6774432182312 141.44582324699422 -1803.3111565589904 221.4438708211137 -1658.217155456543 221.4438708211137C -1513.1231543540955 221.4438708211137 -1388.7568676948547 257.3850226297759 -1243.6628665924072 257.3850226297759C -1098.5688654899598 257.3850226297759 -974.202578830719 42.897503771629545 -829.1085777282715 42.897503771629545C -684.014576625824 42.897503771629545 -559.6482899665832 141.44582324699422 -414.55428886413574 141.44582324699422C -269.4602877616883 141.44582324699422 -145.0940011024475 199.41542293838484 0 199.41542293838484C 145.0940011024475 199.41542293838484 269.4602877616883 315.35462232116697 414.55428886413574 315.35462232116697"></path><g id="SvgjsG1545" class="apexcharts-series-markers-wrap" data:realIndex="0"><g class="apexcharts-series-markers"><circle id="SvgjsCircle1613" r="0" cx="0" cy="0" class="apexcharts-marker w649wnin7 no-pointer-events" stroke="#ffffff" fill="#0694a2" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" default-marker-size="0"></circle></g></g></g><g id="SvgjsG1546" class="apexcharts-datalabels" data:realIndex="0"></g></g><line id="SvgjsLine1608" x1="0" y1="0" x2="414.55428886413574" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1609" x1="0" y1="0" x2="414.55428886413574" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG1610" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG1611" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG1612" class="apexcharts-point-annotations"></g><rect id="SvgjsRect1614" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe" class="apexcharts-zoom-rect"></rect><rect id="SvgjsRect1615" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe" class="apexcharts-selection-rect"></rect></g><rect id="SvgjsRect1539" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe"></rect><g id="SvgjsG1573" class="apexcharts-yaxis" rel="0" transform="translate(40.939186096191406, 0)"><g id="SvgjsG1574" class="apexcharts-yaxis-texts-g"><text id="SvgjsText1575" font-family="Inter, sans-serif" x="20" y="31.6" text-anchor="end" dominant-baseline="auto" font-size="14px" font-weight="500" fill="#6b7280" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Inter, sans-serif;"><tspan id="SvgjsTspan1576">$6600</tspan><title>$6600</title></text><text id="SvgjsText1577" font-family="Inter, sans-serif" x="20" y="89.56959969139098" text-anchor="end" dominant-baseline="auto" font-size="14px" font-weight="500" fill="#6b7280" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Inter, sans-serif;"><tspan id="SvgjsTspan1578">$6500</tspan><title>$6500</title></text><text id="SvgjsText1579" font-family="Inter, sans-serif" x="20" y="147.53919938278196" text-anchor="end" dominant-baseline="auto" font-size="14px" font-weight="500" fill="#6b7280" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Inter, sans-serif;"><tspan id="SvgjsTspan1580">$6400</tspan><title>$6400</title></text><text id="SvgjsText1581" font-family="Inter, sans-serif" x="20" y="205.50879907417294" text-anchor="end" dominant-baseline="auto" font-size="14px" font-weight="500" fill="#6b7280" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Inter, sans-serif;"><tspan id="SvgjsTspan1582">$6300</tspan><title>$6300</title></text><text id="SvgjsText1583" font-family="Inter, sans-serif" x="20" y="263.47839876556395" text-anchor="end" dominant-baseline="auto" font-size="14px" font-weight="500" fill="#6b7280" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Inter, sans-serif;"><tspan id="SvgjsTspan1584">$6200</tspan><title>$6200</title></text><text id="SvgjsText1585" font-family="Inter, sans-serif" x="20" y="321.44799845695496" text-anchor="end" dominant-baseline="auto" font-size="14px" font-weight="500" fill="#6b7280" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Inter, sans-serif;"><tspan id="SvgjsTspan1586">$6100</tspan><title>$6100</title></text><text id="SvgjsText1587" font-family="Inter, sans-serif" x="20" y="379.417598148346" text-anchor="end" dominant-baseline="auto" font-size="14px" font-weight="500" fill="#6b7280" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Inter, sans-serif;"><tspan id="SvgjsTspan1588">$6000</tspan><title>$6000</title></text></g></g><g id="SvgjsG1536" class="apexcharts-annotations"></g></svg><div class="apexcharts-legend" style="max-height: 210px;"></div><div class="apexcharts-tooltip apexcharts-theme-light"><div class="apexcharts-tooltip-title" style="font-family: Inter, sans-serif; font-size: 14px;"></div><div class="apexcharts-tooltip-series-group" style="order: 1;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(6, 148, 162);"></span><div class="apexcharts-tooltip-text" style="font-family: Inter, sans-serif; font-size: 14px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div><div class="apexcharts-xaxistooltip apexcharts-xaxistooltip-bottom apexcharts-theme-light"><div class="apexcharts-xaxistooltip-text" style="font-family: Inter, sans-serif; font-size: 12px;"></div></div><div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light"><div class="apexcharts-yaxistooltip-text"></div></div></div></div>--}}
{{--                </div>--}}
                <div class="bg-white shadow-lg rounded-lg p-4 sm:p-6 xl:p-8 ">

                    <div class="mb-4 flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Latest Transactions</h3>
                            <span class="text-base font-normal text-gray-500">This is a list of latest transactions</span>
                        </div>
                        <div class="flex-shrink-0">
                            <a href="#" class="text-sm font-medium text-cyan-600 hover:bg-gray-100 rounded-lg p-2">View all</a>
                        </div>
                    </div>

                    <div class="flex flex-col mt-8">
                        <div class="overflow-x-auto rounded-lg">
                            <div class="align-middle inline-block min-w-full">
                                <div class="shadow-lg overflow-hidden sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Transaction
                                            </th>
                                            <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Date &amp; Time
                                            </th>
                                            <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Amount
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white">
                                        <tr>
                                            <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                                                Payment from <span class="font-semibold">Bonnie Green</span>
                                            </td>
                                            <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                                Apr 23 ,2021
                                            </td>
                                            <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                                $2300
                                            </td>
                                        </tr>
                                        <tr class="bg-gray-50">
                                            <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900 rounded-lg rounded-left">
                                                Payment refund to <span class="font-semibold">#00910</span>
                                            </td>
                                            <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                                Apr 23 ,2021
                                            </td>
                                            <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                                -$670
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                                                Payment failed from <span class="font-semibold">#087651</span>
                                            </td>
                                            <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                                Apr 18 ,2021
                                            </td>
                                            <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                                $234
                                            </td>
                                        </tr>
                                        <tr class="bg-gray-50">
                                            <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900 rounded-lg rounded-left">
                                                Payment from <span class="font-semibold">Lana Byrd</span>
                                            </td>
                                            <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                                Apr 15 ,2021
                                            </td>
                                            <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                                $5000
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                                                Payment from <span class="font-semibold">Jese Leos</span>
                                            </td>
                                            <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                                Apr 15 ,2021
                                            </td>
                                            <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                                $2300
                                            </td>
                                        </tr>
                                        <tr class="bg-gray-50">
                                            <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900 rounded-lg rounded-left">
                                                Payment from <span class="font-semibold">THEMESBERG LLC</span>
                                            </td>
                                            <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                                Apr 11 ,2021
                                            </td>
                                            <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                                $560
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                                                Payment from <span class="font-semibold">Lana Lysle</span>
                                            </td>
                                            <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                                Apr 6 ,2021
                                            </td>
                                            <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                                $1437
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 2xl:grid-cols-2 xl:gap-4 my-4">

                <div class="bg-white shadow-lg rounded-lg mb-4 p-4 sm:p-6 h-full">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-bold leading-none text-gray-900">Latest Customers</h3>
                        <a href="#" class="text-sm font-medium text-cyan-600 hover:bg-gray-100 rounded-lg inline-flex items-center p-2">
                            View all
                        </a>
                    </div>
                    <div class="flow-root">
                        <ul role="list" class="divide-y divide-gray-200">
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <img class="h-8 w-8 rounded-full" src="https://demo.themesberg.com/windster/images/users/neil-sims.png" alt="Neil image">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate">
                                            Neil Sims
                                        </p>
                                        <p class="text-sm text-gray-500 truncate">
                                            email@windster.com
                                        </p>
                                    </div>
                                    <div class="inline-flex items-center text-base font-semibold text-gray-900">
                                        $320
                                    </div>
                                </div>
                            </li>
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <img class="h-8 w-8 rounded-full" src="https://demo.themesberg.com/windster/images/users/bonnie-green.png" alt="Neil image">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate">
                                            Bonnie Green
                                        </p>
                                        <p class="text-sm text-gray-500 truncate">
                                            email@windster.com
                                        </p>
                                    </div>
                                    <div class="inline-flex items-center text-base font-semibold text-gray-900">
                                        $3467
                                    </div>
                                </div>
                            </li>
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <img class="h-8 w-8 rounded-full" src="https://demo.themesberg.com/windster/images/users/michael-gough.png" alt="Neil image">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate">
                                            Michael Gough
                                        </p>
                                        <p class="text-sm text-gray-500 truncate">
                                            email@windster.com
                                        </p>
                                    </div>
                                    <div class="inline-flex items-center text-base font-semibold text-gray-900">
                                        $67
                                    </div>
                                </div>
                            </li>
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <img class="h-8 w-8 rounded-full" src="https://demo.themesberg.com/windster/images/users/thomas-lean.png" alt="Neil image">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate">
                                            Thomes Lean
                                        </p>
                                        <p class="text-sm text-gray-500 truncate">
                                            email@windster.com
                                        </p>
                                    </div>
                                    <div class="inline-flex items-center text-base font-semibold text-gray-900">
                                        $2367
                                    </div>
                                </div>
                            </li>
                            <li class="pt-3 sm:pt-4 pb-0">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <img class="h-8 w-8 rounded-full" src="https://demo.themesberg.com/windster/images/users/lana-byrd.png" alt="Neil image">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate">
                                            Lana Byrd
                                        </p>
                                        <p class="text-sm text-gray-500 truncate">
                                            email@windster.com
                                        </p>
                                    </div>
                                    <div class="inline-flex items-center text-base font-semibold text-gray-900">
                                        $367
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="bg-white shadow-lg rounded-lg p-4 sm:p-6 xl:p-8 ">

                    <h3 class="text-xl leading-none font-bold text-gray-900 mb-10">Acquisition Overview</h3>
                    <div class="block w-full overflow-x-auto">
                        <table class="items-center w-full bg-transparent border-collapse">
                            <thead>
                            <tr>
                                <th class="px-4 bg-gray-50 text-gray-700 align-middle py-3 text-xs font-semibold text-left uppercase border-l-0 border-r-0 whitespace-nowrap">Top Channels</th>
                                <th class="px-4 bg-gray-50 text-gray-700 align-middle py-3 text-xs font-semibold text-left uppercase border-l-0 border-r-0 whitespace-nowrap">Users</th>
                                <th class="px-4 bg-gray-50 text-gray-700 align-middle py-3 text-xs font-semibold text-left uppercase border-l-0 border-r-0 whitespace-nowrap min-w-140-px"></th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                            <tr class="text-gray-500">
                                <th class="border-t-0 px-4 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">Organic Search</th>
                                <td class="border-t-0 px-4 align-middle text-xs font-medium text-gray-900 whitespace-nowrap p-4">5,649</td>
                                <td class="border-t-0 px-4 align-middle text-xs whitespace-nowrap p-4">
                                    <div class="flex items-center">
                                        <span class="mr-2 text-xs font-medium">30%</span>
                                        <div class="relative w-full">
                                            <div class="w-full bg-gray-200 rounded-sm h-2">
                                                <div class="bg-cyan-600 h-2 rounded-sm" style="width: 30%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="text-gray-500">
                                <th class="border-t-0 px-4 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">Referral</th>
                                <td class="border-t-0 px-4 align-middle text-xs font-medium text-gray-900 whitespace-nowrap p-4">4,025</td>
                                <td class="border-t-0 px-4 align-middle text-xs whitespace-nowrap p-4">
                                    <div class="flex items-center">
                                        <span class="mr-2 text-xs font-medium">24%</span>
                                        <div class="relative w-full">
                                            <div class="w-full bg-gray-200 rounded-sm h-2">
                                                <div class="bg-orange-300 h-2 rounded-sm" style="width: 24%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="text-gray-500">
                                <th class="border-t-0 px-4 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">Direct</th>
                                <td class="border-t-0 px-4 align-middle text-xs font-medium text-gray-900 whitespace-nowrap p-4">3,105</td>
                                <td class="border-t-0 px-4 align-middle text-xs whitespace-nowrap p-4">
                                    <div class="flex items-center">
                                        <span class="mr-2 text-xs font-medium">18%</span>
                                        <div class="relative w-full">
                                            <div class="w-full bg-gray-200 rounded-sm h-2">
                                                <div class="bg-teal-400 h-2 rounded-sm" style="width: 18%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="text-gray-500">
                                <th class="border-t-0 px-4 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">Social</th>
                                <td class="border-t-0 px-4 align-middle text-xs font-medium text-gray-900 whitespace-nowrap p-4">1251</td>
                                <td class="border-t-0 px-4 align-middle text-xs whitespace-nowrap p-4">
                                    <div class="flex items-center">
                                        <span class="mr-2 text-xs font-medium">12%</span>
                                        <div class="relative w-full">
                                            <div class="w-full bg-gray-200 rounded-sm h-2">
                                                <div class="bg-pink-600 h-2 rounded-sm" style="width: 12%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="text-gray-500">
                                <th class="border-t-0 px-4 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">Other</th>
                                <td class="border-t-0 px-4 align-middle text-xs font-medium text-gray-900 whitespace-nowrap p-4">734</td>
                                <td class="border-t-0 px-4 align-middle text-xs whitespace-nowrap p-4">
                                    <div class="flex items-center">
                                        <span class="mr-2 text-xs font-medium">9%</span>
                                        <div class="relative w-full">
                                            <div class="w-full bg-gray-200 rounded-sm h-2">
                                                <div class="bg-indigo-600 h-2 rounded-sm" style="width: 9%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="text-gray-500">
                                <th class="border-t-0 align-middle text-sm font-normal whitespace-nowrap p-4 pb-0 text-left">Email</th>
                                <td class="border-t-0 align-middle text-xs font-medium text-gray-900 whitespace-nowrap p-4 pb-0">456</td>
                                <td class="border-t-0 align-middle text-xs whitespace-nowrap p-4 pb-0">
                                    <div class="flex items-center">
                                        <span class="mr-2 text-xs font-medium">7%</span>
                                        <div class="relative w-full">
                                            <div class="w-full bg-gray-200 rounded-sm h-2">
                                                <div class="bg-purple-500 h-2 rounded-sm" style="width: 7%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="https://demo.themesberg.com/windster/app.bundle.js"></script>
@endsection
