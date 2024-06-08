<?php

function printMessage(string $message, array $messageParameters = []): void
{
	echo strtr($message."\n", $messageParameters);
}
