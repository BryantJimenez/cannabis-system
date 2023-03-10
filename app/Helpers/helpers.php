<?php

function state($state) {
	if ($state=='Inactivo') {
		return '<span class="badge badge-danger">'.$state.'</span>';
	} elseif ($state=='Activo') {
		return '<span class="badge badge-success">'.$state.'</span>';
	}
	return '<span class="badge badge-dark">'.$state.'</span>';
}

function roleUser($user, $badge=true) {
	$num=1;
	$roles="";
	foreach ($user['roles'] as $rol) {
		if ($user->hasRole($rol->name)) {
			$roles.=($user['roles']->count()==$num) ? $rol->name : $rol->name."<br>";
			$num++;
		}
	}

	if (!is_null($user['roles']) && !empty($roles)) {
		if ($badge) {
			return '<span class="badge badge-primary">'.$roles.'</span>';
		} else {
			return $roles;
		}
	} else {
		if ($badge) {
			return '<span class="badge badge-dark">Desconocido</span>';
		} else {
			return 'Desconocido';
		}
	}
}

function active($path, $group=null) {
	if (is_array($path)) {
		foreach ($path as $url) {
			if (is_null($group)) {
				if (request()->is($url)) {
					return 'active';
				}
			} else {
				if (is_int(strpos(request()->path(), $url))) {
					return 'active';
				}
			}
		}
		return '';
	} else {
		if (is_null($group)) {
			return request()->is($path) ? 'active' : '';
		} else {
			return is_int(strpos(request()->path(), $path)) ? 'active' : '';
		}
	}
}

function menu_expanded($path, $group=null) {
	if (is_array($path)) {
		foreach ($path as $url) {
			if (is_null($group)) {
				if (request()->is($url)) {
					return 'true';
				}
			} else {
				if (is_int(strpos(request()->path(), $url))) {
					return 'true';
				}
			}
		}
		return 'false';
	} else {
		if (is_null($group)) {
			return request()->is($path) ? 'true' : 'false';
		} else {
			return is_int(strpos(request()->path(), $path)) ? 'true' : 'false';
		}
	}
}

function submenu($path, $action=null) {
	if (is_array($path)) {
		foreach ($path as $url) {
			if (is_null($action)) {
				if (request()->is($url)) {
					return 'class=active';
				}
			} else {
				if (is_int(strpos(request()->path(), $url))) {
					return 'show';
				}
			}
		}
		return '';
	} else {
		if (is_null($action)) {
			return request()->is($path) ? 'class=active' : '';
		} else {
			return is_int(strpos(request()->path(), $path)) ? 'show' : '';
		}
	}
}

function selectArray($arrays, $selectedItems) {
	$selects="";
	foreach ($arrays as $array) {
		$select="";
		if (count($selectedItems)>0) {
			foreach ($selectedItems as $selected) {
				if (is_object($selected) && $selected->slug==$array->slug) {
					$select="selected";
					break;
				} elseif ($selected==$array->slug) {
					$select="selected";
					break;
				}
			}
		}
		$selects.='<option value="'.$array->slug.'" '.$select.'>'.$array->name.'</option>';
	}
	return $selects;
}

function store_files($file, $file_name, $route) {
	$image=$file_name.".".$file->getClientOriginalExtension();
	if (file_exists(public_path().$route.$image)) {
		unlink(public_path().$route.$image);
	}
	$file->move(public_path().$route, $image);
	return $image;
}

function image_exist($file_route, $image, $user_image=false, $large=true) {
	if (file_exists(public_path().$file_route.$image)) {
		$img=asset($file_route.$image);
	} else {
		if ($user_image) {
			$img=asset("/admins/img/template/usuario.png");
		} else {
			if ($large) {
				$img=asset("/admins/img/template/imagen.jpg");
			} else {
				$img=asset("/admins/img/template/image.jpg");
			}
		}
	}

	return $img;
}

function containerUse($use, $total) {
	if ($use==0) {
		return '<span class="badge badge-danger">'.$use.'/'.$total.'</span>';
	} elseif ($use==$total) {
		return '<span class="badge badge-success">'.$use.'/'.$total.'</span>';
	}
	return '<span class="badge badge-dark">'.$use.'/'.$total.'</span>';
}

function calcDays($start, $end) {
	$days=(strtotime($start)-strtotime($end))/86400;
	$days=abs($days);
	$days=floor($days);
	return $days;
}

function logModule($module) {
	if ($module=='App/Models/Stage') {
		return '<span class="badge badge-primary">PosCosecha</span>';
	}
	return '<span class="badge badge-dark">Desconocido</span>';
}

function logAction($action) {
	if ($action=='Crear') {
		return '<span class="badge badge-primary">'.$action.'</span>';
	} elseif ($action=='Editar') {
		return '<span class="badge badge-secondary">'.$action.'</span>';
	} elseif ($action=='Eliminar') {
		return '<span class="badge badge-danger">'.$action.'</span>';
	} elseif ($action=='Vaciar') {
		return '<span class="badge badge-info">'.$action.'</span>';
	}
	return '<span class="badge badge-dark">'.$action.'</span>';
}