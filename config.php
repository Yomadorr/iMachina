<?

	// overwrite default configs ...
	// default config
	$app->addConfigByValue( "database.host", "string", "localhost:8889" );	 
	$app->addConfigByValue( "database.name", "string", "imachina" );	 
	$app->addConfigByValue( "database.login", "string", "root" );	 
	$app->addConfigByValue( "database.password", "string", "root" );	 
	
	// infos
	// todo: *
	// $app->addConfigByValue(  "email.server", "string", "yes" );
	// $app->addConfigByValue(  "email.server.host", "string", "yes" );

	
	// email
	$app->addConfigByValue(  "email.system", "string", "rene.bauer@zhdk.ch" );

	// email sending server
	$app->addConfigByValue(  "email.usemailserver", "string", "false" );
		$app->addConfigByValue(  "email.host", "string", "lmailer.fhnw.ch" );
		$app->addConfigByValue(  "email.login", "string", "" );
		$app->addConfigByValue(  "email.password", "string", "" );

	// the types add here ...
	// todo: add in ...
	$app->addPublicTypeTypeSub("thread","plain",true);
	$app->addPublicTypeTypeSub("hyperthread","plain",true);

	$app->addPublicTypeTypeSub("text","plain",false);
	$app->addPublicTypeTypeSub("text","rtf",false);
	$app->addPublicTypeTypeSub("text","html",false);

	$app->addPublicTypeTypeSub("image","png",false);

	$app->addPublicTypeTypeSub("audio","wav",false);

	$app->addPublicTypeTypeSub("embed","youtube",false);
	$app->addPublicTypeTypeSub("video","ogg",false);

	$app->addPublicTypeTypeSub("blog","plain",false);
	$app->addPublicTypeTypeSub("link","plain",false);

	// todo: add special things here ...  true > rule ...
	// for min rule !!!!

	
	// debug here
	// $app->debugConfigs();
	// print_r($app);

	// test	it ...
	// echo($app->getConfigValueByName("database.host"));

?>