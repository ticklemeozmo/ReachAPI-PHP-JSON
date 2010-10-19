<?php
	require_once("classes/GlobalFunctions.php");
	
	echo 'If you can see this line of text, you\'ve done everything correctly.';
	//Don't forget to remove the above line of code after you're sure everything is working correctly.
	
	/*This file contains some examples to get you started. Classes are structed almost identically to the
		schemas provided by bungie.net / the object browser in Visual Studio. You should look in the
		class files for definite answers, however.
		
		Check back to the thread on bungie.net for updates to this.
	*/
	
	//These variables are examples only. They may or may not work and are for demonstrative purposes only.
	
	$key = 'YOUR API KEY HERE'; //Do not tell or give anyone your key
	$gamertag = 'dazarobbo';
	$gameId = 135979422;
	$fileId = 1051900;
	$fileSetId = 3760;
	
	/*
		APIRequest::getGameMetadata();
		
		This function assumes you have a metadata file in your resources folder named
		"metadata.json". If it's not there, make sure you get a copy.
		
		Arguments:
			$key: Your API Key
			$useLocalCopy = true: Specifies whether to use a locally cached copy, or
				make a request to bungie.net; default is true (use the cached copy).
		
		Returns:
			MetaDataResponse
	*/
	/*
		$metadata = APIRequest::getGameMetadata($key);
		echo $metadata->Data->getCommendationById(3)->Description;
	*/
	
	
	
	/*
		APIRequest::getGameHistory();
	
		Returns a list of recent games
	
		Arguments:
			$key: Your API Key
			$gamertag: A player's gamertag
			$variant_class: Type of variant list to filter by ("Campaign", "Firefight", "Competitive", "Arena", "Unknown"). Default is "Unknown"
			$iPage: 0-based pagination. Default is 0
	
		Returns:
			GameHistoryResponse
	*/
	/*
		$history = APIRequest::getGameHistory($key, $gamertag);
		foreach($history->RecentGames as $RecentGame){
			echo '<a href="game.php?gameId=' . $RecentGame->GameId . '">game.php?gameId=' . $RecentGame->GameId . '</a><br />';
		}		
	*/
	
	
	
	/*
		APIRequest::getGameDetails();
		
		Returns details about a game
		
		Arguments:
			$key: Your API Key
			$gameId: A gameId value
	
		Returns:
			Game	
	*/
	/*
		$game = APIRequest::getGameDetails($key, $gameId);
		echo $game->GameDetails->MapName;
	*/
	
	
	
	/*
		APIRequest::getPlayerDetailsWithStatsByMap();
	
		Returns an absolute -blam!-load of stats about a player and maps they've played on.
		
		Arguments:
			$key: Your API Key
			$gamertag: A player's gamertag
			
		Returns:
			PlayerDetailsResponse
	*/
	/*
		$statsByMap = APIRequest::getPlayerDetailsWithStatsByMap($key, $gamertag);
		echo '<img src="http://bungie.net' . $statsByMap->PlayerModelUrl . '" />';
	*/
	
	
	
	/*
		APIRequest::getPlayerDetailsWithStatsByPlayList();
		
		Returns loads of stats about a player and the playlists they've played in.
		
		Arguments:
			$key: Your API Key
			$gamertag: A player's gamertag
			
		Returns:
			PlayerDetailsResponse
	*/
	/*
		$statsByPlaylist = APIRequest::getPlayerDetailsWithStatsByPlayList($key, $gamertag);
		foreach($statsByPlaylist->StatisticsByPlaylist as $StatisticByPlaylist){
			//Iterate over each playlist, output total kills for each
			echo $StatisticByPlaylist->total_kills . '<br />';
		}
	*/
	
	
	
	/*
		APIRequest::getPlayerDetailsWithNoStats();
		
		Returns basic details about a player (much less than the other two function above)
		
		Arguments:
			$key: Your API Key
			$gamertag: A player's gamertag
			
		Returns:
			PlayerDetailsResponse
	*/
	/*
		$noStats = APIRequest::getPlayerDetailsWithNoStats($key, $gamertag);
		echo $noStats->Player->service_tag;
	*/
	
	
	
	/*
		APIRequest::getPlayerFileShare();
	
		Returns a list of files and file sets in a player's file share
		
		Arguments:
			$key: Your API Key
			$gamertag: A player's gamertag
	
		Returns:
			FileResponse
	*/
	/*
		$fileShare = APIRequest::getPlayerFileShare($key, $gamertag);
		foreach($fileShare->Files as $File){
			echo $File->Title . ': ' . $File->FileId . '<br />'; //Iterate over each file and output its title
		}
	*/
	
	
	
	/*
		APIRequest::getFileDetails();
		
		Returns details about a file
	
		Arguments:
			$key: Your API Key
			$fileId: Id value of a file
			
		Returns:
			ReachFile
	*/
	/*
		$file = APIRequest::getFileDetails($key, $fileId);
		echo $file->Files[0]->Author;
	*/
	
	
	
	/*
		APIRequest::getPlayerRecentScreenshots();
	
		Returns a list of a player's recent screenshots
		
		Arguments:
			$key: Your API Key
			$gamertag: A player's gamertag
	
		Returns:
			FileResponse
	*/
	/*
		$recentSShots = APIRequest::getPlayerRecentScreenshots($key, $gamertag);
		foreach($recentSShots->Files as $SShot){
			echo '<img src="http://bungie.net' . $SShot->ScreenshotThumbnailUrl . '" /><br />';
		}
	*/
	
	
	
	/*
		APIRequest::getPlayerFileSets();
		
		Returns a list of a player's file sets
		
		Arguments:
			$key: Your API Key
			$gamertag: A player's gamertag
			
		Returns:
			FileResponse
	*/
	/*
		$fileSets = APIRequest::getPlayerFileSets($key, $gamertag);
		foreach($fileSets->FileSets as $fileSet){
			echo $fileSet->Name . ': ' . $fileSet->Id . '<br />'; //Each file set's Name and Id
		}
	*/
	
	
	
	/*
		APIRequest::getPlayerFileSetFiles();
		
		Returns a list of files in a file set
	
		Arguments:
			$key: Your API Key
			$gamertag: A player's gamertag
			$fileSetId: Id of a file set the player has
			
		Returns:
			FileResponse
	*/
	/*
		$fileSetFiles = APIRequest::getPlayerFileSetFiles($key, $gamertag, $fileSetId);
		foreach($fileSetFiles->Files as $File){
			echo $File->Title . '<br />';
		}
	*/
	
	
	
	/*
		APIRequest::getPlayerRenderedVideos();
	
		Returns a list of rendered videos
		
		Arguments:
			$key: Your API Key
			$gamertag: A player's gamertag
			$iPage: 0-based pagination. Default is 0
			
		Returns:
			FileResponse
	*/
	/*
		$renderedVideos = APIRequest::getPlayerRenderedVideos($key, $gamertag);
		foreach($renderedVideos->Files as $renderedVideo){
			echo '<a href="' . $renderedVideo->RenderedWMVPath . '">Download!</a><br />';
		}
	*/
	
	
	
	/*
		APIRequest::doReachFileSearch();
	
		Returns a list of files based on search terms
		
		Arguments:
			$key: Your API Key
			$file_category: The category to search in ("Image", "GameClip", "GameMap", "GameSettings")
			$iPage: 0-based pagination. Default is 0
			$mapFilter: A mapId. Default is "null" which is essentially no map filter
			$engineFiler: Game mode to filter by ("Campaign", "Forge", "Multiplayer", "Firefight", "null"). Default is "null"
			$dateFilter: Self explanatory ("Day", "Week", "Month", "All"). Default is "All"
			$sortFilter: Further filtering ("MostRelevant", "MostRecent", "MostDownloads", "HighestRated"). Default is "MostRelevant"
			$tags: Semicolon delimited list of tags to include. Default is "" (no tags)
	
		Returns:
			FileResponse
	*/
	/*
		//The following are valid argument lists
		$fileSearch = APIRequest::doReachFileSearch($key, 'GameClip');
		$fileSearch = APIRequest::doReachFileSearch($key, 'Image', 0, 5010, 'Campaign', 'Month', 'MostDownloads', 'carter;kat;noble');
		$fileSearch = APIRequest::doReachFileSearch($key, 'GameClip', 3, '5020', 'null', 'Week', 'HighestRated', '');
		
		//This is an INVALID search
		//$fileSearch = APIRequest::doReachFileSearch($key, 'Image', , 7030); //You cannot skip a default argument then specify another to the right of it
	
		foreach($fileSearch->Files as $File){
			echo '&quot;' . $File->Title . '&quot; which is a ' . $File->FileCategory . ' and is by ' . $File->Author . '<br />';
		}
	
	*/	
?>