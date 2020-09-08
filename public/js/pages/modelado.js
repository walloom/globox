import * as THREE from '/plugins/threejs/three.module.js';
import { TransformControls } from '/plugins/threejs/jsm/controls/TransformControls.js';

var wBase, hBase;
var display;
var transformControl;

var camera, scene, renderer;
var plane;
var mouse, raycaster, isShiftDown = false;

var rollOverMesh, rollOverMaterial;
var cubeGeo, cubeMaterial;

var objects = [];

init();
render();

function init() {

  var container = document.getElementById('displayRender');
  var positionInfo = container.getBoundingClientRect();
  wBase = positionInfo.width;
  hBase = positionInfo.height;

  camera = new THREE.PerspectiveCamera(45, wBase / hBase, 1, 10000);
  camera.position.set(500, 800, 1300);
  camera.lookAt(0, 0, 0);

  scene = new THREE.Scene();
  scene.background = new THREE.Color(0xf0f0f0);

  // roll-over helpers

  var rollOverGeo = new THREE.BoxBufferGeometry(50, 50, 50);
  rollOverMaterial = new THREE.MeshBasicMaterial({ color: 0x000000, opacity: 0.5, transparent: true });
  rollOverMesh = new THREE.Mesh(rollOverGeo, rollOverMaterial);
  scene.add(rollOverMesh);

  // cubes

  cubeGeo = new THREE.BoxBufferGeometry(50, 50, 50);
  cubeMaterial = new THREE.MeshLambertMaterial({ color: 0xfeb74c, map: new THREE.TextureLoader().load('/img/textures/square-outline-textured.png') });

  // grid

  var gridHelper = new THREE.GridHelper(1000, 20);
  scene.add(gridHelper);

  //

  raycaster = new THREE.Raycaster();
  mouse = new THREE.Vector2();

  var geometry = new THREE.PlaneBufferGeometry(1000, 1000);
  geometry.rotateX(- Math.PI / 2);

  plane = new THREE.Mesh(geometry, new THREE.MeshBasicMaterial({ visible: false }));
  scene.add(plane);

  objects.push(plane);

  // lights

  var ambientLight = new THREE.AmbientLight(0x606060);
  scene.add(ambientLight);

  var directionalLight = new THREE.DirectionalLight(0xffffff);
  directionalLight.position.set(1, 0.75, 0.5).normalize();
  scene.add(directionalLight);

  renderer = new THREE.WebGLRenderer({ antialias: true });
  renderer.setPixelRatio(window.devicePixelRatio);
  renderer.setSize(wBase, hBase);

  display = document.getElementById("displayRender");
  display.appendChild(renderer.domElement);
  // document.body.appendChild(renderer.domElement);


  display.addEventListener('mousemove', onDocumentMouseMove, false);
  display.addEventListener('mousedown', onDocumentMouseDown, false);
  document.addEventListener('keydown', onDocumentKeyDown, false);
  document.addEventListener('keyup', onDocumentKeyUp, false);

  window.addEventListener('resize', onWindowResize, false);


  // transformControl = new TransformControls(camera, renderer.domElement);
  // transformControl.addEventListener('change', render);

}

function onWindowResize() {
  camera.aspect = wBase / hBase;
  camera.updateProjectionMatrix();
  renderer.setSize(wBase, hBase);
}

function getOffset( el ) {
  var _x = 0;
  var _y = 0;
  while( el && !isNaN( el.offsetLeft ) && !isNaN( el.offsetTop ) ) {
      _x += el.offsetLeft - el.scrollLeft;
      _y += el.offsetTop - el.scrollTop;
      el = el.offsetParent;
  }
  return { top: _y, left: _x };
}

function onDocumentMouseMove(event) {
  event.preventDefault();

  var x = getOffset( document.getElementById('displayRender') ).left; 
  var y = getOffset( document.getElementById('displayRender') ).top; 

  mouse.set(((event.clientX-x) / wBase) * 2 - 1, - ((event.clientY-y) / hBase) * 2 + 1);

  raycaster.setFromCamera(mouse, camera);

  var intersects = raycaster.intersectObjects(objects);

  if (intersects.length > 0) {

    var intersect = intersects[0];

    rollOverMesh.position.copy(intersect.point).add(intersect.face.normal);
    rollOverMesh.position.divideScalar(50).floor().multiplyScalar(50).addScalar(25);

  }

  render();

}

function onDocumentMouseDown(event) {

  event.preventDefault();

  var x = getOffset( document.getElementById('displayRender') ).left; 
  var y = getOffset( document.getElementById('displayRender') ).top; 

  console.log(event.clientX-x, " - ", event.clientY-y);

  mouse.set(((event.clientX-x) / wBase) * 2 - 1, - ((event.clientY-y) / hBase) * 2 + 1);
  raycaster.setFromCamera(mouse, camera);

  var intersects = raycaster.intersectObjects(objects);
  if (intersects.length > 0) {
    var intersect = intersects[0];

    // delete cube
    if (isShiftDown) {
      if (intersect.object !== plane) {
        scene.remove(intersect.object);
        objects.splice(objects.indexOf(intersect.object), 1);
      }
      // create cube
    } else {
      var voxel = new THREE.Mesh(cubeGeo, cubeMaterial);
      voxel.position.copy(intersect.point).add(intersect.face.normal);
      voxel.position.divideScalar(50).floor().multiplyScalar(50).addScalar(25);
      scene.add(voxel);

      objects.push(voxel);
    }
    render();
  }

}

make.setRacksModels = function( racks, levels, sections ){
  console.log(racks, levels, sections);
  
  camera.position.set(0, 800, 0);
  camera.lookAt(0, 0, 0);
  render();

  for(var r = 0; r<racks; r++){
    for (var i=0;i<(sections*2); i++){
      let x = ((65+(i*50)) / wBase) * 2 - 1;
      let y = - ((80+(r*150)) / hBase) * 2 + 1;
      for (var j=0;j<levels; j++){
        putBox(x, y);
      }
    }
  }
  
  
  camera.position.set(500, 800, 1300);
  camera.lookAt(0, 0, 0);

  render();
}

function putBox( x, y ){
  mouse.set(x, y);
  raycaster.setFromCamera(mouse, camera);

  var intersects = raycaster.intersectObjects(objects);
  if (intersects.length > 0) {
    var intersect = intersects[0];
    
    var voxel = new THREE.Mesh(cubeGeo, cubeMaterial);
    voxel.position.copy(intersect.point).add(intersect.face.normal);
    voxel.position.divideScalar(50).floor().multiplyScalar(50).addScalar(25);
    scene.add(voxel);
  
    objects.push(voxel);
  }

  render();
}

function onDocumentKeyDown(event) {

  switch (event.keyCode) {

    case 16: isShiftDown = true; break;

  }

}

function onDocumentKeyUp(event) {

  switch (event.keyCode) {

    case 16: isShiftDown = false; break;

  }

}

function render() {
  renderer.render(scene, camera);
}