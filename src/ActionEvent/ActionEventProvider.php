<?php


namespace Schierproducts\UserEngagementApi\ActionEvent;


use Schierproducts\UserEngagementApi\Interfaces\ActionEvent\ActionEventInterface;
use Schierproducts\UserEngagementApi\Interfaces\ActionEvent\ActionEventQuery;

interface ActionEventProvider
{
    /**
     * Perform a search and return a list of action events
     *
     * @param ActionEventQuery $query
     * @return mixed
     */
    public function list(ActionEventQuery $query);

    /**
     * Create a new action event
     *
     * @param ActionEventInterface $actionEvent
     * @return mixed
     */
    public function create(ActionEventInterface $actionEvent);

    /**
     * Return an action event
     *
     * @param int $id
     * @return mixed
     */
    public function retrieve(int $id);

    /**
     * Generates a link that can be used to track an various links
     *
     * @param string $url
     * @param string $email
     * @param string $type The type of event; can be "email" or "product"
     * @return string
     */
    public function link(string $url, string $email, string $type);
}
