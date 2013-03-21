<link href="<?php echo $this->path.'/css/toolbutton.css'; ?>" type="text/css" rel="stylesheet" />

<div class="maintoolbox"  style="display: inline-block;">   
    <?php 
    foreach($this->buttons as $key=>$crumb) {
		$classButton = '';
		$prev = $key - 1;
		if ( empty($this->buttons[$prev]) ) {
			if ( next($this->buttons)  ) {
				$classButton = 'isnextbotton'; 
				prev($this->buttons);
			}else{
				$first = true;
			}
		} else {
			$next = next($this->buttons);
			$next = next($this->buttons);
			
			if ( !empty($next['name']) ) {
				$middle = true;
				$classButton = 'ismiddlebotton';
			}else{
				$last = true;
				$classButton = 'islastbotton';
			}
			
			prev($this->buttons);
		}
		
		if ( isset($crumb['htmlOption']) ){
			$htmlOption = '';
			foreach ( $crumb['htmlOption'] as $keyOption =>$option)
				$htmlOption .= ((!empty($htmlOption)) ? ' ':'').$keyOption.'="'.$option.'"';
		}
		
		
		?>
		<div class="toolbutton <?php echo $classButton?>" id = "<?php echo $crumb['id']?>"  <?php echo $htmlOption?>>
		<?php if ( $crumb['url'] ) { ?>
            <?php echo CHtml::link($crumb['name'], $crumb['url']); ?>
		<?php } else { ?>
			<?php echo $crumb['name']; ?>
		<?php } ?>
		<?php if ( $crumb['lefticon'] ) { ?>	
			<div class="<?php echo $crumb['lefticon']; ?>">&nbsp;</div>
		<?php } ?>	
		</div>
		<?php	
        /*if(isset($crumb['url'])) {
			?>
			
			<div class="toolbutton <?php echo (next($this->buttons) ? 'isnextbotton' : 'islastbotton')?>">
            <?php echo $crumb['name']; //CHtml::link($crumb['name'], $crumb['url']); ?>
			</div>
		<?php	
        } else {
            ?>
			<div class="toolbutton <?php echo ((prev($this->buttons)) ? 'isnmidlebotton' : ( next($this->buttons) ? 'isnextbotton' : 'islastbotton'))?>">
            <?php echo $crumb['name']; ?>
			</div>
       <?php
		}
		*/
       /* if(next($this->buttons)) {
                    ?>
			<div class="toolbutton" style="display: inline-block;">
			<?php  echo $this->delimiter;?>
			</div>
       <?php
        } */
    }
    ?>
</div>