<?php

namespace Schierproducts\UserEngagementApi\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static LoggedIn()
 * @method static static CreateProject()
 * @method static static CompletedSizing()
 * @method static static SubmittedPreApproval()
 * @method static static ViewedKickout()
 * @method static static AddedAddress()
 * @method static static CloneProject()
 * @method static static CloseProject()
 * @method static static AddedNote()
 * @method static static SignedUp()
 * @method static static ViewedProduct()
 * @method static static SharedSizing()
 * @method static static SuggestFeatures()
 * @method static static EmailClicks()
 */
final class ActionEventType extends Enum
{
    const LoggedIn = 'loggedIn';
    const CreateProject = 'createProject';
    const CompletedSizing = 'completedSizing';
    const SubmittedPreApproval = 'submittedPreApproval';
    const ViewedKickout = 'viewedKickout';
    const AddedAddress = 'addedAddress';
    const CloneProject = 'cloneProject';
    const CloseProject = 'closeProject';
    const AddedNote = 'addedNote';
    const SignedUp = 'signedUp';
    const ViewedProduct = 'viewedProduct';
    // TODO time in app
    const SharedSizing = 'sharedSizing';
    const SuggestFeatures = 'suggestFeatures';
    const EmailClicks = 'emailClicks';
}
