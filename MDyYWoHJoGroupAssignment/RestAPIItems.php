<?php

require_once('inc\config.inc.php');

require_once('inc\Entities\Item.class.php');

require_once('inc\Utilities\PDOAgent.class.php');
require_once('inc\Utilities\ItemMapper.class.php');
require_once('inc\Utilities\Page.class.php');

ItemMapper::initialize("Item");

parse_str(file_get_contents('php://input'), $requestData);

switch($_SERVER['REQUEST_METHOD']) {
    case "GET":
        if (isset($requestData['id'])) {
            $item = ItemMapper::getItem($requestData['id']);

            $serializeItem = $item->jsonSerialize();

            header('Content-Type: application/json');
            echo json_encode($serializeItem);
        }

        else {
        $items = ItemMapper::selectAll();

        $serializeItems = array();

        foreach($items as $item) {
            $serializeItems[] = $item->jsonSerialize();
        }

        header('Content-Type: application/json');

        echo json_encode($serializeItems);
        }
        break;
    case "POST":
        $ni = new Item();
        $ni->setItemName($requestData['name']);
        $ni->setItemDesc($requestData['desc']);
        $ni->setItemPrice($requestData['price']);
        $ni->setItemAvail($requestData['avail']);

        $result = ItemMapper::createItem($ni);

        header('Content-Type: application/json');
        echo json_encode($result);
        break;
    case "DELETE":
        $result = ItemMapper::deleteItem($requestData['id']);

        header('Content-Type: application/json');

        echo json_encode($result);
        break;
    case "PUT":
        $ei = new Item();
        $ei->setItemName($requestData['name']);
        $ei->setItemDesc($requestData['desc']);
        $ei->setItemPrice($requestData['price']);
        $ei->setItemAvail($requestData['avail']);

        $result = ItemMapper::updateItem($ei, $requestData['itemID']);

        header('Content-Type: application/json');

        echo json_encode($result);
        break;
    default:
        echo json_encode(array("message" => "404 error Not Found"));
        break;
}
?>