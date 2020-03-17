@extends('layouts.index')
@section('internal-style')
	{{ Html::style('https://api.tiles.mapbox.com/mapbox-gl-js/v0.49.0/mapbox-gl.css') }}
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
	{{ Html::script("https://api.tiles.mapbox.com/mapbox-gl-js/v0.49.0/mapbox-gl.js") }}
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

		map.on('load', function() {
			map.addSource("evb", {
				type: "geojson",
				data:
				{
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
					"type": "FeatureCollection"
				},
				cluster: true,
				clusterMaxZoom: 14,
				clusterRadius: 50
			});

			map.addLayer({
				id: "clusters",
				type: "circle",
				source: "evb",
				filter: ["has", "point_count"],
				paint: {
					"circle-color": [
						"step",
						["get", "point_count"],
						"#FF5608",
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

			map.addLayer({
				id: "cluster-count",
				type: "symbol",
				source: "evb",
				filter: ["has", "point_count"],
				layout: {
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
					"circle-radius": 4,
					"circle-stroke-width": 1,
					"circle-stroke-color": "#fff"
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
