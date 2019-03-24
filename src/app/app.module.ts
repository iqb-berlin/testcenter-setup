import { AboutComponent } from './about/about.component';
import { BrowserModule } from '@angular/platform-browser';
import { HttpClientModule } from '@angular/common/http';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { NgModule, Input, Output, EventEmitter, OnInit } from '@angular/core';
import { ReactiveFormsModule } from '@angular/forms';

import { MatButtonModule, MatCheckboxModule, MatMenuModule, MatTooltipModule, MatCardModule,
  MatToolbarModule, MatIconModule, MatDialogModule, MatFormFieldModule, MatInputModule,
  MatTabsModule, MatProgressSpinnerModule, MatRadioModule, MatProgressBarModule } from '@angular/material';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';

import { IqbCommonModule } from './iqb-common';
import { BackendService } from './backend.service';
import { StartComponent } from './start/start.component';
import { LocationStrategy, HashLocationStrategy } from '@angular/common';
import { FlexLayoutModule } from '@angular/flex-layout';
import { ErrormsgComponent } from './errormsg/errormsg.component';
import { httpInterceptorProviders } from './app.interceptor';
import { CustomTextPipe } from './custom-text.pipe';


@NgModule({
  declarations: [
    AppComponent,
    StartComponent,
    AboutComponent,
    ErrormsgComponent,
    CustomTextPipe
  ],
  imports: [
    BrowserModule,
    BrowserAnimationsModule,
    MatButtonModule,
    MatFormFieldModule,
    MatMenuModule,
    MatToolbarModule,
    MatProgressBarModule,
    MatIconModule,
    MatInputModule,
    MatTooltipModule,
    MatCheckboxModule,
    MatRadioModule,
    MatDialogModule,
    MatTabsModule,
    MatProgressSpinnerModule,
    MatCardModule,
    FlexLayoutModule,
    ReactiveFormsModule,
    HttpClientModule,
    MatToolbarModule,
    AppRoutingModule,
    IqbCommonModule
  ],
  providers: [
    BackendService,
    httpInterceptorProviders,
    {
      provide: LocationStrategy,
      useClass: HashLocationStrategy
    }
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
