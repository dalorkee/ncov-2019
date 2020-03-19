@extends('layouts.index')
@section('internal-style')
	{{ Html::style('https://api.tiles.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.css') }}
	<style>
		.mapboxgl-popup {
			max-width: 400px;
			font: 12px/20px 'Helvetica Neue', Arial, Helvetica, sans-serif;
		}
		ul.evb-popup {
			min-width: 200px;
			margin: 0;
			padding: 0;
			list-style: none;
		}
		ul.evb-popup li {
			margin: 3px 0;
			padding: 0 0 0 5px;
		}
		ul.evb-popup li>span:first-child {
			margin-right: 2px;
			font-weight: bold;
			display: inline-block;
			width: 90px;
		}
	</style>
@endsection
@section('meta-token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('contents')
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Clusters</li>
				</ol>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div id="map" style="width: 100%; height: 100vh;"></div>
</div>
@endsection
@section('bottom-script')
	<!-- PAGE PLUGINS -->
	{{ Html::script("https://api.tiles.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.js") }}
	<script>
		$(function () {
			/* Date range picker */
			$('#findEvents').daterangepicker({
				format: 'DD/MM/YYYY'
			})
		});
	</script>
	<script>
		mapboxgl.accessToken = 'pk.eyJ1IjoiZGFsb3JrZWUiLCJhIjoiY2pnbmJrajh4MDZ6aTM0cXZkNDQ0MzI5cCJ9.C2REqhILLm2HKIQSn9Wc0A';
		var map = new mapboxgl.Map({
			container: 'map',
			style: 'mapbox://styles/mapbox/streets-v11',
			center: [ 100.897475, 9.237541],
			zoom: 4.6
		});

		var size = 200;

// implementation of CustomLayerInterface to draw a pulsing dot icon on the map
// see https://docs.mapbox.com/mapbox-gl-js/api/#customlayerinterface for more info
var pulsingDot = {
width: size,
height: size,
data: new Uint8Array(size * size * 4),

// get rendering context for the map canvas when layer is added to the map
onAdd: function() {
var canvas = document.createElement('canvas');
canvas.width = this.width;
canvas.height = this.height;
this.context = canvas.getContext('2d');
},

// called once before every frame where the icon will be used
render: function() {
var duration = 1000;
var t = (performance.now() % duration) / duration;

var radius = (size / 2) * 0.3;
var outerRadius = (size / 2) * 0.7 * t + radius;
var context = this.context;

// draw outer circle
context.clearRect(0, 0, this.width, this.height);
context.beginPath();
context.arc(
this.width / 2,
this.height / 2,
outerRadius,
0,
Math.PI * 2
);
context.fillStyle = 'rgba(255, 200, 200,' + (1 - t) + ')';
context.fill();

// draw inner circle
context.beginPath();
context.arc(
this.width / 2,
this.height / 2,
radius,
0,
Math.PI * 2
);
context.fillStyle = 'rgba(255, 100, 100, 1)';
context.strokeStyle = 'white';
context.lineWidth = 2 + 4 * (1 - t);
context.fill();
context.stroke();

// update this image's data with data from the canvas
this.data = context.getImageData(
0,
0,
this.width,
this.height
).data;

// continuously repaint the map, resulting in the smooth animation of the dot
map.triggerRepaint();

// return `true` to let the map know that the image was updated
return true;
}
};

		map.on('load', function() {
			map.addImage('pulsing-dot', pulsingDot, { pixelRatio: 2 });
			map.addSource("evb", {
				type: "geojson",
				data:
				{
					"type": "FeatureCollection",
					"crs": {
						"properties": {
							"name": "urn:ogc:def:crs:OGC:1.3:CRS84"
						},
						"type": "name"
					},
					"features": [
						@php
						$caseData->each(function($item) {
							$popup = "<ul class='evb-popup'>";
							$popup .= "<li><span>Cluster</span><span>".$item->cluster_id."</span></li>";
							$popup .= "<li><span>สถานที่</span><span>".$item->station_desc."</span></li>";
							$popup .= "</ul>";
							$str =
							 "{
								\"geometry\": {
									\"coordinates\": [".($item->lng).",".($item->lat)."],
									\"type\": \"Point\"
								},
								\"properties\": {
									\"description\": \"".$popup."\",
									\"desc\": \"".$popup."\",
									\"id\": \"ev".$item->cluster_id."\",
									\"cluster_id\": ".$item->cluster_id."
								},
								\"type\": \"Feature\"
							},";
							echo $str;
						});
						@endphp
					],
				},
				cluster: true,
				clusterMaxZoom: 14,
				clusterRadius: 50
			});
/*
			map.addLayer({
				id: "clusters",
				type: "circle",
				source: "evb",
				filter: ["has", "point_count"],
				paint: {
					"circle-color": [
						"step",
						["get", "point_count"],
						"#D23148",
						100,
						"#DE4150",
						300,
						"#f28cb1",
						600,
						"#ff00ff"
					],
					"circle-radius": [
						"step",
						["get", "point_count"],
						20,
						100,
						30,
						750,
						40
					]
				}
			});
			*/

			map.addLayer({
				id: "cluster-count",
				type: "symbol",
				source: "evb",
				filter: ["has", "point_count"],
				layout: {
					'icon-image': 'pulsing-dot',
					"text-field": "{point_count_abbreviated}",
					"text-font": ["DIN Offc Pro Medium", "Arial Unicode MS Bold"],
					"text-size": 12
				}
			});

			map.addLayer({
				id: "unclustered-point",
				type: "circle",
				source: "evb",
				filter: ["!", ["has", "point_count"]],
				paint: {
					'circle-color': [
						'match',
						['get', 'cluster_id'],
						1, '#B03060',
						2, '#FF0000',
						3, '#FFFF00',
						4, '#FF00FF',
						5, '#1E90FF',
						'#000000'
					],
					"circle-radius": 10,
					"circle-stroke-width": 2,
					"circle-stroke-color": "#ffffff"
				}
			});

			// inspect a cluster on click
			map.on('click', 'clusters', function (e) {

				var features = map.queryRenderedFeatures(e.point, { layers: ['clusters'] });
				var clusterId = features[0].properties.cluster_id;
				map.getSource('evb').getClusterExpansionZoom(clusterId, function (err, zoom) {
					if (err)
						return;
					map.easeTo({
						center: features[0].geometry.coordinates,
						zoom: zoom
					});
				});
			});

			map.on('mouseenter', 'clusters', function () {
				map.getCanvas().style.cursor = 'pointer';
			});

			map.on('mouseleave', 'clusters', function () {
				map.getCanvas().style.cursor = '';
			});

			map.on('click', 'unclustered-point', function (e) {
				var coordinates = e.features[0].geometry.coordinates.slice();
				var desc = e.features[0].properties.desc;

				while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
					coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
				}

				new mapboxgl.Popup()
				.setLngLat(coordinates)
				.setHTML(desc)
				.addTo(map);
			});


			// Change the cursor to a pointer when the mouse is over the places layer.
			map.on('mouseenter', 'unclustered-point', function () {
				map.getCanvas().style.cursor = 'pointer';
			});

			// Change it back to a pointer when it leaves.
			map.on('mouseleave', 'unclustered-point', function () {
				map.getCanvas().style.cursor = '';
			});
		});
	</script>
@endsection
