(function() {
var BX = window.BX;
if (BX.RenderParts)
{
	return;
}

BX.RenderParts =
{
	currentUserSonetGroupIdList: [],
	mobile: false,
	publicSection: false,
	currentExtranetUser: false,
	availableUsersList: []
};

BX.RenderParts.init = function(params)
{
	if (typeof params.currentUserSonetGroupIdList != 'undefined')
	{
		this.currentUserSonetGroupIdList = params.currentUserSonetGroupIdList;
	}
	if (typeof params.publicSection != 'undefined')
	{
		this.publicSection = !!params.publicSection;
	}
	this.mobile = !!params.mobile;

	if (typeof params.currentExtranetUser != 'undefined')
	{
		this.currentExtranetUser = !!params.currentExtranetUser;
	}

	if (
		this.currentExtranetUser
		&& typeof params.availableUsersList != 'undefined'
	)
	{
		this.availableUsersList = BX.util.array_values(params.availableUsersList);
	}
};

BX.RenderParts.getNodeSG = function(entity)
{
	var hidden = (
		typeof entity.VISIBILITY != 'undefined'
		&& entity.VISIBILITY == 'group_members'
		&& !BX.util.in_array(entity.ENTITY_ID, this.currentUserSonetGroupIdList)
	);

	if (hidden)
	{
		return this.getNodeHiddenDestination();
	}
	else
	{
		return (
			!this.mobile
				? BX.create('a', {
					attrs: {
						href: entity.LINK,
						target: '_blank'
					},
					text: entity.NAME
				})
				: BX.create('span', {
					text: entity.NAME
				})
		);
	}
};

BX.RenderParts.getNodeU = function(entity)
{
	var hidden = (
		this.currentExtranetUser
		&& !BX.util.in_array(entity.ENTITY_ID, this.availableUsersList)
	);

	if (hidden)
	{
		return this.getNodeHiddenDestination();
	}
	else
	{
		return (
			!this.mobile
				? BX.create('a', {
					attrs: {
						href: entity.LINK
					},
					props: {
						className: 'blog-p-user-name' + (entity.VISIBILITY == 'extranet' ? ' blog-p-user-name-extranet' : '')
					},
					text: entity.NAME
				})
				: BX.create('a', {
					attrs: {
						href: entity.LINK
					},
					text: entity.NAME
				})
		);
	}
};

BX.RenderParts.getNodeDR = function(entity)
{
	return (
		!this.mobile
			? BX.create('a', {
				attrs: {
					href: entity.LINK,
					target: '_blank'
				},
				text: entity.NAME
			})
			: BX.create('span', {
				text: entity.NAME
			})
	);
};

BX.RenderParts.getNodeTask = function(entity)
{
	return (
		!this.mobile
		&& !this.publicSection
		&& entity.LINK.length > 0
		&& typeof entity.VISIBILITY != 'undefined'
		&& typeof entity.VISIBILITY.userId != 'undefined'
		&& parseInt(entity.VISIBILITY.userId) == parseInt(BX.message('USER_ID'))
			? BX.create('a', {
				attrs: {
					href: entity.LINK,
					target: '_blank'
				},
				text: entity.NAME
			})
			: BX.create('span', {
				text: entity.NAME
			})
	);
};

BX.RenderParts.getNodeCreateTaskSourceComment = function(entity)
{
	var sourceEntityType = (BX.type.isNotEmptyString(entity.SOURCE_ENTITY_TYPE) ? entity.SOURCE_ENTITY_TYPE : 'BLOG_COMMENT');

	var entityTitle = BX.message('SONET_COMMENTAUX_JS_CREATETASK_' + sourceEntityType + '_LINK');
	if (!BX.type.isNotEmptyString(entityTitle))
	{
		entityTitle = BX.message('SONET_COMMENTAUX_JS_CREATETASK_BLOG_COMMENT_LINK')
	}

	return (
		(
			!this.mobile
			&& !this.publicSection
			&& entity.LINK.length > 0
		)
			? BX.create('a', {
				attrs: {
					href: entity.LINK,
					target: '_blank'
				},
				text: entityTitle
			})
			: BX.create('span', {
				text: entityTitle
			})
	);
};

BX.RenderParts.getNodeUA = function()
{
	return BX.create('span', {
		text: BX.message('SONET_RENDERPARTS_JS_DESTINATION_ALL')
	});
};

BX.RenderParts.getNodeHiddenDestination = function()
{
	return BX.create('span', {
		text: BX.message('SONET_RENDERPARTS_JS_HIDDEN')
	});
};


})();