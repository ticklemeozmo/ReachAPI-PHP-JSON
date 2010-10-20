<?php	
	//Requests
	function APIRequest($path){
		define('BASE_URL', 'http://www.bungie.net/api/reach/reachapijson.svc', false);
		
		$json = @file_get_contents(BASE_URL . $path);
	
		if(!$json){
			throw new Exception('file_get_contents failed');
		}
		
		$json = json_decode($json);
		if(!$json){
			throw new Exception('json_decode failed');
		}
		
		return $json;
	}
	function getGameMetadata($id, $useLocalCopy = true){
		///game/metadata/{identifier}
		
		if($useLocalCopy){
			$json = file_get_contents("resources/metadata.json");
			$json = json_decode($json);
			return new MetaDataResponse($json);
		}
		
		$path = '/game/metadata/' . rawurlencode($id);
		return new MetaDataResponse(APIRequest($path));
	}
	function getGameHistory($id, $gamertag, $variant_class = 'Unknown', $iPage = 0){
		///player/gamehistory/{identifier}/{gamertag}/{variant_class_string}/{iPage}
		
		//variant_class = {"Campaign", "Firefight", "Competitive", "Arena", "Unknown"}
		
		$path = '/player/gamehistory/' . rawurlencode($id) . '/' . rawurlencode($gamertag) . '/' . rawurlencode($variant_class) . '/' . $iPage;
		return new GameHistoryResponse(APIRequest($path));
	}
	function getGameDetails($id, $gameId){
		///game/details/{identifier}/{gameId}
		$path = '/game/details/' . rawurlencode($id) . '/' . $gameId;
		return new GameDetailsResponse(APIRequest($path));
	}
	function getPlayerDetailsWithStatsByMap($id, $gamertag){
		///player/details/bymap/{identifier}/{gamertag}
		$path = '/player/details/bymap/' . rawurlencode($id) . '/' . rawurlencode($gamertag);
		return new PlayerDetailsResponse(APIRequest($path));
	}
	function getPlayerDetailsWithStatsByPlaylist($id, $gamertag){
		///player/details/byplaylist/{identifier}/{gamertag}
		$path = '/player/details/byplaylist/' . rawurlencode($id) . '/' . rawurlencode($gamertag);
		return new PlayerDetailsResponse(APIRequest($path));
	}
	function getPlayerDetailsWithNoStats($id, $gamertag){
		///player/details/nostats/{identifier}/{gamertag}
		$path = '/player/details/nostats/' . rawurlencode($id) . '/' . rawurlencode($gamertag);
		return new PlayerDetailsResponse(APIRequest($path));
	}
	function getPlayerFileShare($id, $gamertag){
		///file/share/{identifier}/{gamertag}
		$path = '/file/share/' . rawurlencode($id) . '/' . rawurlencode($gamertag);
		return new FileResponse(APIRequest($path));
	}
	function getFileDetails($id, $fileId){
		///file/details/{identifier}/{fileId}
		$path = '/file/details/' . rawurlencode($id) . '/' . $fileId;
		return new FileResponse(APIRequest($path));
	}
	function getPlayerRecentScreenshots($id, $gamertag){
		///file/screenshots/{identifier}/{gamertag}
		$path = '/file/screenshots/' . rawurlencode($id) . '/' . rawurlencode($gamertag);
		return new FileResponse(APIRequest($path));
	}
	function getPlayerFileSets($id, $gamertag){
		///file/sets/{identifier}/{gamertag}
		$path = '/file/sets/' . rawurlencode($id) . '/' . rawurlencode($gamertag);
		return new FileResponse(APIRequest($path));
	}
	function getPlayerFileSetFiles($id, $gamertag, $fileSetId){
		///file/sets/files/{identifier}/{gamertag}/{fileSetId}	
		$path = '/file/sets/files/' . rawurlencode($id) . '/' . rawurlencode($gamertag) . '/' . $fileSetId;
		return new FileResponse(APIRequest($path));
	}
	function getPlayerRenderedVideos($id, $gamertag, $iPage = 0){
		///file/videos/{identifier}/{gamertag}/{iPage}
		$path = '/file/videos/' . rawurlencode($id) . '/' . rawurlencode($gamertag) . '/' . $iPage;
		return new FileResponse(APIRequest($path));
	}

	/*!	@function getCurrentChallenges
	  	@abstract returns a GameChallengesResponse object for Bungie's challenges of the day.
		@result GameChallengesResponse Object - challenges for the day
	 */
	function getCurrentChallenges(){
		///game/challenges/{identifier}/
		$path = '/game/challenges/' . rawurlencode(APIKEY);
		$return = APIRequest($path);
		return new GameDetailsResponse(APIRequest($path));
	}

	function doReachFileSearch($id, $file_category, $iPage = 0, $mapFilter = 'null', $engineFilter = 'null', $dateFilter = 'All', $sortFilter = 'MostRelevant', $tags = ''){
		///file/search/{identifier}/{file_category}/{MapFilter}/{engineFilter}/{DateFilter}/{SortFilter}/{iPage}?tags={tags}
		
		//file_category = {"Image", "GameClip", "GameMap", "GameSettings"}
		//mapFilter = {mapId, "null"}
		//engineFilter = {"Campaign", "Forge", "Multiplayer", "Firefight", "null"}
		//dateFilter = {"Day", "Week", "Month", "All"}
		//sortFilter = {"MostRelevant", "MostRecent", "MostDownloads", "HighestRated"}
		//tags = a semicolon delimited list of tags, otherwise blank
		
		$path = '/file/search/' . rawurlencode($id) . '/' . $file_category . '/' . $mapFilter . '/' . $engineFilter . '/' . $dateFilter . '/' . $sortFilter . '/' . $iPage . '?tags=' . $tags;
		return new FileResponse(APIRequest($path));
	}

	//Other
	function __autoload($className){
		require_once($className . '.php');
	}
	function getBoolStr($bool){
		if($bool){
			return 'true';
		}
		return 'false';
	}
	function getPlacingSuffix($str){
		if($str === '11' || $str === '12' || $str === '13'){
			return 'th';
		}
		$sub = $str[strlen($str) - 1];
		if($sub === '1'){
			return 'st';
		}
		if($sub === '2'){
			return 'nd';
		}
		else if($sub === '3'){
			return 'rd';
		}
		else{
			return 'th';
		}
	}
	function parseJSONDate($theDate){
		$theDate = str_replace(array('/Date(', ')/'), '', $theDate);
		
		$expr = '/^\d{10}|(-|\+)\d+$/';
		preg_match_all($expr, $theDate, $theDate, PREG_PATTERN_ORDER);
		
		date_default_timezone_set('America/Los_Angeles');
		
		//$theDate = date_create_from_format('U O', ($theDate[0][0] . ' ' . $theDate[0][1]));
		//Webhost has old[er] PHP version, refer to function below for compatibile workaround

		$theDate = date_create('@' . $theDate[0][0]);
		$theDate->setTimezone(new DateTimeZone('America/Los_Angeles'));
		
		return $theDate;	
	}
	function validateIPage($pageNum){
		$expr = '/^[1-9]+[0-9]*$/'; //Numbers shouldn't be beginning with a 0
		if(preg_match($expr, $page)){
			return true;
		}
		return false;
	}
	function validatePlayerGamertag($gamertag){
		/*
			Xbox gamertag rules
		
			1–15 characters
			a–z, A–Z, 0–9 and space
			it must begin alphabetically
			it cannot end in a space
			and it cannot contain two spaces in a row.
		*/
		
		$gamertagRegex = '/^(?=.{1,15}$)[a-zA-Z][a-zA-Z0-9]*(?: [a-zA-Z0-9]+)*$/';

		if(preg_match($gamertagRegex, $gamertag)){
			return true;
		}
		return false;
	}
?>
