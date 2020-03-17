@extends('layouts.index')
@section('custom-style')
	<link rel="stylesheet" href="{{ URL::asset('assets/libs/jquery-contextmenu/dist/jquery.contextMenu.min.css') }}">
	<link rel='stylesheet' href="{{ URL::asset('assets/libs/datatables-1.10.20/datatables-1.10.20/css/jquery.dataTables.min.css') }}">
	<link rel='stylesheet' href="{{ URL::asset('assets/libs/datatables-1.10.20/Buttons-1.6.1/css/buttons.dataTables.min.css') }}">
	<link rel='stylesheet' href="{{ URL::asset('assets/libs/datatables-1.10.20/Responsive-2.2.3/css/responsive.dataTables.min.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('assets/libs/select2-4.0.13/dist/css/select2.min.css') }}">
	<link href="https://api.tiles.mapbox.com/mapbox-gl-js/v0.53.1/mapbox-gl.css" rel="stylesheet">
	<link href="https://api.mapbox.com/mapbox-assembly/v0.23.2/assembly.min.css" rel="stylesheet">
@endsection
@section('internal-style')
<style>
.page-wrapper {
	background: white !important;
}
.dataTables_wrapper {
	width: 100% !important;
	font-family: 'Fira-code', tahoma !important;
}
#list-data-table {
	width: 100% !important;
}
/* table.dataTable td.sorting_1 { background-color: #eee; border:1px lightgrey; } */
/* table.dataTable td { background-color: red;  border:1px lightgrey;} */
table.dataTable tr.odd { background-color: #F6F6F6;  border:1px lightgrey;}
table.dataTable tr.even{ background-color: white; border:1px lightgrey; }
</style>
@endsection
@section('top-script')

@endsection
@section('meta-token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('contents')
<div class="page-breadcrumb bg-light">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title"><span style="display:none;">Invest List</span></h4>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">Maps</a></li>
						<li class="breadcrumb-item active" aria-current="page"><a href="#">Clusters</a></li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid">

</div><!-- flu-contrainer -->
@endsection
@section('bottom-script')
	<script src="https://api.tiles.mapbox.com/mapbox-gl-js/v0.53.1/mapbox-gl.js"></script>
	<script src="https://d3js.org/d3.v4.min.js"></script>

	<script>
	<!-- OPTIONAL SCRIPTS -->
	{{ Html::script(('AdminLTE/dist/js/demo.js')) }}
	<!-- PAGE PLUGINS -->
	<script src="https://api.tiles.mapbox.com/mapbox-gl-js/v0.53.1/mapbox-gl.js"></script>
	<script src="https://d3js.org/d3.v4.min.js"></script>
	<!-- SlimScroll 1.3.0 -->
	{{ Html::script(('AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js')) }}
	<script>

	const powerplants = {
	  "type": "FeatureCollection",
	  "features": [
		{
		  "type": "Feature",
		  "properties": {
			"description": 'PJ',
			"country_long": "Thailand",
			"fuel1": "Hydro"
		  },
		  "geometry": {
			"type": "Point",
			"coordinates": [
			  100.119,
			  13.322
			]
		  }
		},
		{
		  "type": "Feature",
		  "properties": {
			"description": 'PJ',
			"country_long": "Thailand",
			"fuel1": "Hydro"
		  },
		  "geometry": {
			"type": "Point",
			"coordinates": [
			  100.4787,
			  13.556
			]
		  }
		},
		{
		  "type": "Feature",
		  "properties": {
			"description": 'PJ',
			"country_long": "Thailand",
			"fuel1": "Hydro"
		  },
		  "geometry": {
			"type": "Point",
			"coordinates": [
			  100.717,
			  13.641
			]
		  }
		},
		{
		  "type": "Feature",
		  "properties": {
			"description": 'PJ',
			"country_long": "Thailand",
			"fuel1": "Hydro"
		  },
		  "geometry": {
			"type": "Point",
			"coordinates": [
			  100.3633,
			  13.4847
			]
		  }
		},
		{
		  "type": "Feature",
		  "properties": {
			"description": 'PJ',
			"country_long": "Thailand",
			"fuel1": "Gas"
		  },
		  "geometry": {
			"type": "Point",
			"coordinates": [
			  100.1134,
			  13.5638
			]
		  }
		},
		{
		  "type": "Feature",
		  "properties": {
			"description": 'PJ',
			"country_long": "Thailand",
			"fuel1": "Hydro"
		  },
		  "geometry": {
			"type": "Point",
			"coordinates": [
			  100.71,
			  13.9416
			]
		  }
		},
		{
		  "type": "Feature",
		  "properties": {
			"description": 'PJ',
			"country_long": "Thailand",
			"fuel1": "Hydro"
		  },
		  "geometry": {
			"type": "Point",
			"coordinates": [
			  100.7757,
			  13.5865
			]
		  }
		},
		{
		  "type": "Feature",
		  "properties": {
			"description": 'PJ',
			"country_long": "Thailand",
			"fuel1": "Hydro"
		  },
		  "geometry": {
			"type": "Point",
			"coordinates": [
			  100.1047,
			  13.9116
			]
		  }
		},
		{
		  "type": "Feature",
		  "properties": {
			"description": 'PJ',
			"country_long": "Thailand",
			"fuel1": "Hydro"
		  },
		  "geometry": {
			"type": "Point",
			"coordinates": [
			  100.0431,
			  13.2514
			]
		  }
		},
		{
		  "type": "Feature",
		  "properties": {
			"description": 'PJ',
			"country_long": "Thailand",
			"fuel1": "Hydro"
		  },
		  "geometry": {
			"type": "Point",
			"coordinates": [
			  100.8224,
			  13.1033
			]
		  }
		},
		{
		  "type": "Feature",
		  "properties": {
			"description": 'PJ',
			"country_long": "Thailand",
			"fuel1": "Hydro"
		  },
		  "geometry": {
			"type": "Point",
			"coordinates": [
			  100.7619,
			  13.5222
			]
		  }
		}
	  ]
	}

	</script>
	<script>
		mapboxgl.accessToken = 'pk.eyJ1IjoiZGFsb3JrZWUiLCJhIjoiY2pnbmJrajh4MDZ6aTM0cXZkNDQ0MzI5cCJ9.C2REqhILLm2HKIQSn9Wc0A';
		var map = new mapboxgl.Map({
			container: 'map',
			style: 'mapbox://styles/mapbox/streets-v11',
			center: [ 100.897475, 9.237541],
			zoom: 4.6
		});

		const colors = ['#EA4335','#ffffb3','#bebada','#fb8072','#80b1d3','#fdb462','#b3de69','#fccde5','#d9d9d9','#bc80bd','#ccebc5'];

		const colorScale = d3.scaleOrdinal()
		  .domain(["hydro", "solar", "wind", "gas", "oil","coal", "biomass", "waste", "nuclear", "geothermal", "others"])
		  .range(colors)

		const hydro = ['==', ['get', 'fuel1'], 'Hydro'];
		const solar = ['==', ['get', 'fuel1'], 'Solar'];
		const wind = ['==', ['get', 'fuel1'], 'Wind'];
		const gas = ['==', ['get', 'fuel1'], 'Gas'];
		const oil = ['==', ['get', 'fuel1'], 'Oil'];
		const coal = ['==', ['get', 'fuel1'], 'Coal'];
		const biomass = ['==', ['get', 'fuel1'], 'Biomass'];
		const waste = ['==', ['get', 'fuel1'], 'Waste'];
		const nuclear = ['==', ['get', 'fuel1'], 'Nuclear'];
		const geothermal = ['==', ['get', 'fuel1'], 'Geothermal'];
		const others = ['any',
		  ['==', ['get', 'fuel1'], 'Cogeneration'],
		  ['==', ['get', 'fuel1'], 'Storage'],
		  ['==', ['get', 'fuel1'], 'Other'],
		  ['==', ['get', 'fuel1'], 'Wave and Tidel'],
		  ['==', ['get', 'fuel1'], 'Petcoke'],
		  ['==', ['get', 'fuel1'], '']
		];

		map.on('load', () => {
		  // add a clustered GeoJSON source for powerplant
		  map.addSource('powerplants', {
			'type': 'geojson',
			'data': powerplants,
			'cluster': true,
			'clusterRadius': 100,
			'clusterProperties': { // keep separate counts for each fuel category in a cluster
			  'hydro': ['+', ['case', hydro, 1, 0]],
			  'solar': ['+', ['case', solar, 1, 0]],
			  'wind': ['+', ['case', wind, 1, 0]],
			  'gas': ['+', ['case', gas, 1, 0]],
			  'oil': ['+', ['case', oil, 1, 0]],
			  'coal': ['+', ['case', coal, 1, 0]],
			  'biomass': ['+', ['case', biomass, 1, 0]],
			  'waste': ['+', ['case', waste, 1, 0]],
			  'nuclear': ['+', ['case', nuclear, 1, 0]],
			  'geothermal': ['+', ['case', geothermal, 1, 0]],
			  'others': ['+', ['case', others, 1, 0]]
			}
		  });

		  map.addLayer({
			'id': 'powerplant_individual',
			'type': 'circle',
			'source': 'powerplants',
			'filter': ['!=', ['get', 'cluster'], true],
			'paint': {
			  'circle-color': ['case',
				hydro, colorScale('hydro'),
				solar, colorScale('solar'),
				wind, colorScale('wind'),
				gas, colorScale('gas'),
				oil, colorScale('oil'),
				coal, colorScale('coal'),
				biomass, colorScale('biomass'),
				waste, colorScale('waste'),
				nuclear, colorScale('nuclear'),
				geothermal, colorScale('geothermal'),
				others, colorScale('others'), '#ffed6f'],
			  'circle-radius': 5
			}
		  });

			map.addLayer({
			  'id': 'powerplant_individual_outer',
			  'type': 'circle',
			  'source': 'powerplants',
			  'filter': ['!=', ['get', 'cluster'], true],
			  'paint': {
				'circle-stroke-color': ['case',
				  hydro, colorScale('hydro'),
				  solar, colorScale('solar'),
				  wind, colorScale('wind'),
				  gas, colorScale('gas'),
				  oil, colorScale('oil'),
				  coal, colorScale('coal'),
				  biomass, colorScale('biomass'),
				  waste, colorScale('waste'),
				  nuclear, colorScale('nuclear'),
				  geothermal, colorScale('geothermal'),
				  others, colorScale('others'), '#ffed6f'],
				'circle-stroke-width': 2,
				'circle-radius': 10,
				'circle-color': "rgba(0, 0, 0, 0)"
			  }
			});



			let markers = {};
			let markersOnScreen = {};
			let point_counts = [];
			let totals;

			const getPointCount = (features) => {
			  features.forEach(f => {
				if (f.properties.cluster) {
				  point_counts.push(f.properties.point_count)
				}
			  })

			  return point_counts;
			};

			const updateMarkers = () => {
			  document.getElementById('key').innerHTML = '';
			  let newMarkers = {};
			  const features = map.querySourceFeatures('powerplants');
			  totals = getPointCount(features);
			  features.forEach((feature) => {
				const coordinates = feature.geometry.coordinates;
				const props = feature.properties;

				if (!props.cluster) {
				  return;
				};


				const id = props.cluster_id;

				let marker = markers[id];
				if (!marker) {
				  const el = createDonutChart(props, totals);
				  marker = markers[id] = new mapboxgl.Marker({
					element: el
				  })
				  .setLngLat(coordinates)
				}

				newMarkers[id] = marker;

				if (!markersOnScreen[id]) {
				  marker.addTo(map);
				}
			  });

			  for (id in markersOnScreen) {
				if (!newMarkers[id]) {
				  markersOnScreen[id].remove();
				}
			  }
				markersOnScreen = newMarkers;
			};

			const createDonutChart = (props, totals) => {
			  const div = document.createElement('div');
			  const data = [
				{type: 'hydro', count: props.hydro},
				{type: 'solar', count: props.solar},
				{type: 'wind', count: props.wind},
				{type: 'oil', count: props.oil},
				{type: 'gas', count: props.gas},
				{type: 'coal', count: props.coal},
				{type: 'biomass', count: props.biomass},
				{type: 'waste', count: props.waste},
				{type: 'nuclear', count: props.nuclear},
				{type: 'geothermal', count: props.geothermal},
				{type: 'others', count: props.others},
			  ];

			  const thickness = 10;
			  const scale = d3.scaleLinear()
				.domain([d3.min(totals), d3.max(totals)])
				.range([500, d3.max(totals)])

			  const radius = Math.sqrt(scale(props.point_count));
			  const circleRadius = radius - thickness;

			  const svg = d3.select(div)
				.append('svg')
				.attr('class', 'pie')
				.attr('width', radius * 2)
				.attr('height', radius * 2);

			  //center
			  const g = svg.append('g')
				.attr('transform', `translate(${radius}, ${radius})`);

			  const arc = d3.arc()
				.innerRadius(radius - thickness)
				.outerRadius(radius);

			  const pie = d3.pie()
				.value(d => d.count)
				.sort(null);

			  const path = g.selectAll('path')
				.data(pie(data.sort((x, y) => d3.ascending(y.count, x.count))))
				.enter()
				.append('path')
				.attr('d', arc)
				.attr('fill', (d) => colorScale(d.data.type))

			  const circle = g.append('circle')
				.attr('r', circleRadius)
				.attr('fill', 'rgba(0, 0, 0, 0.7)')
				.attr('class', 'center-circle')

			  const text = g
				.append("text")
				.attr("class", "total")
				.text(props.point_count_abbreviated)
				.attr('text-anchor', 'middle')
				.attr('dy', 5)
				.attr('fill', 'white')

				const infoEl = createTable(props);

				svg.on('click', () => {
				  d3.selectAll('.center-circle').attr('fill', 'rgba(0, 0, 0, 0.7)')
				  circle.attr('fill', 'rgb(71, 79, 102)')
				  document.getElementById('key').innerHTML = '';
				  document.getElementById('key').append(infoEl);
				})

			  return div;
			}

			const createTable = (props) => {
			  const getPerc = (count) => {
				return count/props.point_count;
			  };

			  const data = [
				{type: 'hydro', perc: getPerc(props.hydro)},
				{type: 'solar', perc: getPerc(props.solar)},
				{type: 'wind', perc: getPerc(props.wind)},
				{type: 'oil', perc: getPerc(props.oil)},
				{type: 'gas', perc: getPerc(props.gas)},
				{type: 'coal', perc: getPerc(props.coal)},
				{type: 'biomass', perc: getPerc(props.biomass)},
				{type: 'waste', perc: getPerc(props.waste)},
				{type: 'nuclear', perc: getPerc(props.nuclear)},
				{type: 'geothermal', perc: getPerc(props.geothermal)},
				{type: 'others', perc: getPerc(props.others)},
			  ];

			  const columns = ['type', 'perc']
			  const div = document.createElement('div');
			  const table = d3.select(div).append('table').attr('class', 'table')
				const thead = table.append('thead')
				const	tbody = table.append('tbody');

				thead.append('tr')
				  .selectAll('th')
				  .data(columns).enter()
				  .append('th')
					.text((d) => {
				  let colName = d === 'perc' ? '%' : 'Fuel Type'
				  return colName;
				})

				const rows = tbody.selectAll('tr')
				  .data(data.filter(i => i.perc).sort((x, y) => d3.descending(x.perc, y.perc)))
				  .enter()
				  .append('tr')
				.style('border-left', (d) => `20px solid ${colorScale(d.type)}`);

				// create a cell in each row for each column
				const cells = rows.selectAll('td')
				  .data((row) => {
					return columns.map((column) => {
					let val = column === 'perc' ? d3.format(".2%")(row[column]) : row[column];
					  return {column: column, value: val};
					});
				  })
				  .enter()
				  .append('td')
					.text((d) => d.value)
				.style('text-transform', 'capitalize')

			  return div;
			}

			map.on('data', (e) => {
			  if (e.sourceId !== 'powerplants' || !e.isSourceLoaded) return;

			  map.on('move', updateMarkers);
			  map.on('moveend', updateMarkers);
			  updateMarkers();
			});

			map.on('click', 'powerplant_individual', function (e) {
				var coordinates = e.features[0].geometry.coordinates.slice();
				var desc = e.features[0].properties.description;

				while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
					coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
				}

				new mapboxgl.Popup()
				.setLngLat(coordinates)
				.setHTML(desc)
				.addTo(map);
			});
		});
	</script>



@endsection
