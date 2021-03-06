<?php


class NotifyMeHooks {
	public static function onBeforeCreateEchoEvent( &$notifications, $notificationCategories )  {
		$notifications['user-notify'] = array(
		    'category' => 'system',
		    'section' => 'alert',
		    'primary-link' => array(
		        'message' => 'notifyme-primary-message',
		        'destination' => 'agent'
		    ),
		    'formatter-class' => 'EchoBasicFormatter',
		    'title-message' => 'notifyme-notification-title',
		    'title-params' => array( 'agent' ),
		    'flyout-message' => 'notifyme-notification-flyout',
		    'flyout-params' => array( 'agent' ),
		    'email-subject-message' => 'notifyme-email-subject',
		    'email-subject-params' => array( 'agent' ),
		    'email-body-batch-message' => 'notifyme-email-batch-body',
		    'email-body-batch-params' =>  array( 'agent' )
		);
		return true;
	}

	public static function onEchoGetDefaultNotifiedUsers( $event, &$users ) {
		switch ( $event->getType() ) {
			case 'user-notify':
				$extra = $event->getExtra();
				$userId = $extra['notify-user-id'];
				$user = User::newFromId( $userId );
				$users[$userId] = $user;
				break;
		}
		return true;
	}
}



