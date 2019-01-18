import { CheckConfigData } from './backend.service';
import { BehaviorSubject } from 'rxjs';
import { Injectable } from '@angular/core';
// import { e } from '@angular/core/src/render3';
// import { truncateSync } from 'fs';

@Injectable({
  providedIn: 'root'
})
export class SyscheckDataService {
  public pageTitle$ = new BehaviorSubject<string>('IQB-Testcenter - System-Check');

  public checkConfig$ = new BehaviorSubject<CheckConfigData>(null);
  public environmentData$ = new BehaviorSubject<ReportEntry[]>([]);
  public networkData$ = new BehaviorSubject<ReportEntry[]>([]);
  public questionnaireData$ = new BehaviorSubject<ReportEntry[]>([]);

  public unitcheckEnabled$ = new BehaviorSubject<boolean>(false);
  public questionnaireEnabled$ = new BehaviorSubject<boolean>(false);
  public reportEnabled$ = new BehaviorSubject<boolean>(false);

  // for Navi-Buttons:
  public showNaviButtons$ = new BehaviorSubject<boolean>(false);
  public itemplayerValidPages$ = new BehaviorSubject<string[]>([]);
  public itemplayerCurrentPage$ = new BehaviorSubject<string>('');
  public itemplayerPageRequest$ = new BehaviorSubject<string>('');

  constructor() {
    this.checkConfig$.subscribe(cDef => {
      this.networkData$.next([]);
      this.questionnaireData$.next([]);
    });
  }

  setPageTitle() {
    this.pageTitle$.next('IQB-Testcenter - System-Check');
  }
}

export interface ReportEntry {
  label: string;
  value: string;
}

