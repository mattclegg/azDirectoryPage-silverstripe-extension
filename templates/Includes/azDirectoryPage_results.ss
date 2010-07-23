<% if Results %><% control Results.GroupedBy(FirstLetter) %>
<div id='expert_results_$FirstLetter'>
	<a name="section_$FirstLetter"><h1>$FirstLetter</h1></a>
	<ul>
	<% control Children %>
		<li>
			<div id='expert_result_$ID'>
				<p class="alignright_address">
				<% if Street %><% if Building %>$Building,&nbsp;<% end_if %>$Street,<br/><% else %><% if Building %>$Building<br/><% end_if %><% end_if %>
				<% if City %>$City,<br/><% end_if %>
				<% if Area %>$Area,<br/><% end_if %>
				<% if PostCode %>$PostCode,<br/><% end_if %>
				<% if Phone1 %>$Phone1,<br/><% end_if %>
				<% if Phone2 %>$Phone2,<br/><% end_if %>
				<% if Phone3 %>$Phone3,<br/><% end_if %>
				</p>
				<h3>$Department</h3>
				<h4>$Name</h4>
				
				
				<% if Content %>$Content<% end_if %>
				<% if Content %>$Content.ContextSummary(null,business)<% end_if %>
				<p class="alignbottom_links">
					<% if Email %><a href="mailto:$Email" title="Email $Name"><img src="sharethis/images/icons/email.png" alt="Email" height="16" width="16"></a><% end_if %>
					<% if Twitter %><a href="$Twitter" title="Follow $Name"><img src="sharethis/images/icons/twitter.png" alt="Twitter" height="16" width="16"></a><% end_if %>
					<% if WebsiteRSS %><a href="$WebsiteRSS" title="Subscribe to $Name"><img src="sharethis/images/icons/twitter.png" alt="RSS" height="16" width="16"></a><% end_if %>
					<% if YouTube %><a href="$YouTube" title="Watch $Name"><img src="sharethis/images/icons/twitter.png" alt="YouTube" height="16" width="16"></a><% end_if %>
					<% if WebsiteURL %><br/><a href="$WebsiteURL" title="$Name Website">$WebsiteURL</a><% end_if %>
					<% if WebsiteURL2 %><br/><a href="$WebsiteURL2" title="$Department Website">$WebsiteURL2</a><% end_if %>
				</p>
			</div>
		</li> 
	<% end_control %>
	</ul>
</div>
<% end_control %><% end_if %>
